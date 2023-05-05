<?php

require_once "{$_SERVER["DOCUMENT_ROOT"]}/support/database.php";

abstract class Model
{
	public ?string $uuid;

	public static abstract function tableName(): string;

	public static function where(array $filters, ?int $limit = 1): Model|array|null {
		$table = static::tableName();

        $query = "SELECT * FROM $table";

        if (count($filters) > 0) {
            $query .= " WHERE ";
            $columns = array_keys($filters);
            foreach ($columns as $index => $column) {
                $query .= " " . ($index > 0 ? "AND " : "") . "`$column` = ?";
            }
        }

        if (isset($limit)) {
            $query .= " LIMIT $limit";
        }

		$statement = database()->prepare("$query;");

		$statement->execute(array_values($filters));

		$result = $statement->fetchAll();

        if (!$result)
            return null;

        $result = array_map(fn ($r) => new static(...$r), $result);

        return count($result) === 1 ? $result[0] : $result;
	}

	public static function find(string $uuid): Model {
		$table = static::tableName();

		$statement = database()->prepare("SELECT * FROM $table WHERE `uuid` = ?;");

		$statement->execute([$uuid]);

		$result = $statement->fetch();

		return new static(...$result);
	}

	/**
	 * @throws Exception
	 */
	public abstract function create(): Model;

	public abstract function update(): void;

	protected function generateUuid(): string
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