<?php

require_once "./support/database.php";

abstract class Model
{

	public ?string $uuid;

	public static abstract function tableName(): string;

//	public static function find(string $uuid): self
//	{
//		$table = static::tableName();
//
//		$query = database()->prepare("SELECT * FROM :table where uuid = :uuid");
//
//		$query->execute(compact("uuid", "table"));
//
//		return new static(...$query->fetch());
//	}

	/**
	 * @throws Exception
	 */
	public function create(): self
	{
		$table = static::tableName();

		if (!isset($this->uuid)) {
			$this->uuid = $this->generateUuid();
		}

		$class      = new ReflectionClass(static::class);
		$properties = $class->getProperties(ReflectionProperty::IS_PUBLIC);

		$fields = substr(
			array_reduce($properties,
				function (string $value, ReflectionProperty $property) {
					if ($property->getValue($this))
						$value .= "{$property->getName()},";

					return $value;
				},
				""
			),
			0,
			-1
		);

		$values = substr(
			array_reduce($properties,
				function (string $value, ReflectionProperty $property) {
					if ($property->getValue($this))
						$value .= "'{$property->getValue($this)}', ";

					return $value;
				},
				""),
			0,
			-2
		);

		$result = database()->query("INSERT INTO $table ($fields) VALUES($values)");

		if ($result->rowCount()) {
			return $this;
		} else {
			throw new Exception("Er is iets fout gegaan tijdens het verwerken van je registratie. Probeer het later nog eens.");
		}
	}

	private function generateUuid(): string
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