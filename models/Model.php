<?php

require_once "{$_SERVER["ROOT_PATH"]}/support/database.php";

abstract class Model
{
	public ?string $uuid;

    /**
     * The name for the table containing all records for this Model.
     * @return string
     */
	public static abstract function tableName(): string;

    /**
     * Seeks a model/models with the given filters.
     *
     * @param array $filters
     *  A key-value pair of columns and the desired value. Can be specified as ['column' => 'value', 'column2' => 'value2']
     *  To specify a comparison operator, specify an array as the value, using the `value` and `operator` keys:
     *      ['column' => ['value' => 'value', 'operator' => 'LIKE']]
     * @param int|null $limit
     *  The amount of results desired, defaults to 1, set to NULL for all results.
     * @return static|array|null
     *  Returns:
     *   - one Model object if $limit = 1,
     *   - an array if $limit == null || $limit > 1,
     *   - null if $limit = 1 and no results were found.
     * @throws Exception
     *   Any `Exception` PDO might throw when executing the query.
     */
	public static function where(array $filters, ?int $limit = 1): static|array|null {
		$table = static::tableName();

        $query = "SELECT * FROM $table";

        if (count($filters) > 0) {
            $query .= " WHERE ";
            $columns = array_keys($filters);
            foreach ($columns as $index => $column) {
                if ($index >0)
                    $query .= "AND ";
                else
                    $query .= " ";

                if (is_array($filters[$column])) { # If a comparison operator is passed as second element to the column array
                    $operator = array_key_exists("operator", $filters[$column]) ? $filters[$column]['operator'] : "=";

                    $query .= "`$column` $operator ?";
                } else {
                    $query .= "`$column` = ?";
                }
            }
        }

        if (isset($limit)) {
            $query .= " LIMIT $limit";
        }

		$statement = database()->prepare("$query;");

		$statement->execute(array_map(function ($column, $filter) {
            if (is_array($filter)) {
                if (array_key_exists("value", $filter)) {
                    return $filter["value"];
                } else {
                    throw new ValueError("Unexpected option found in the filter for $column");
                }
            } else {
                return $filter;
            }
		}, array_keys($filters), array_values($filters)));

		$result = $statement->fetchAll();

        if (!$result && $limit === 1) {
            return null;
        } else if (!$result && $limit !== 1) {
            return [];
        }

        $result = array_map(fn ($r) => new static(...$r), $result);

        return $limit === 1 ? $result[0] : $result;
	}

    /**
     * Attempts to find the Model by the primary key `uuid`.
     *
     * @param string $uuid
     *  The primary key of the Model.
     * @return static|null
     *  The constructed model with all parameters or `null` if the Model couldn't be found.
     * @throws Exception
     *  Any `Exception` PDO might throw when executing the query.
     */
	public static function find(string $uuid): ?static {
		$table = static::tableName();

		$statement = database()->prepare("SELECT * FROM $table WHERE `uuid` = ?;");

		$statement->execute([$uuid]);

		$result = $statement->fetch();

		return is_null($result) ? null : new static(...$result);
	}

	/**
     * Creates a new record with all data contained in the current Model.
     * Optionally generates an `uuid` if it was not set already.
     *
     * @return static
     *  The created Model, optionally with the newly generated primary key.
	 * @throws Exception
     *  Any `Exception` PDO can throw when executing a query.
	 */
	public abstract function create(): static;

    /**
     * Updates all fields for this model in the database.
     *
     * @return void
     * @throws Exception
     *  Any `Exception` PDO can throw when executing a query.
     */
	public abstract function update(): void;

	public static function generateUuid(): string
	{
		# Happily copied from https://www.php.net/manual/en/function.uniqid.php#94959
		# Why oh why does PHP not have builtin UUID generation?!
		return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

			// 32 bits for "time_low"
			mt_rand(0, 0xffff),
			mt_rand(0, 0xffff),

			// 16 bits for "time_mid"
			mt_rand(0, 0xffff),

			// 16 bits for "time_hi_and_version",
			// four most significant bits holds version number 4
			mt_rand(0, 0x0fff) | 0x4000,

			// 16 bits, 8 bits for "clk_seq_hi_res",
			// 8 bits for "clk_seq_low",
			// two most significant bits holds zero and one for variant DCE1.1
			mt_rand(0, 0x3fff) | 0x8000,

			// 48 bits for "node"
			mt_rand(0, 0xffff),
			mt_rand(0, 0xffff),
			mt_rand(0, 0xffff)
		);
	}
}