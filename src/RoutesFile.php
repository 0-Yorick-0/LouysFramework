<?php declare(strict_types=1);

final class RoutesFile
{
	private $routesFile;

	public function __construct(string $rootDirectory)
	{
		$this->routesFile = $rootDirectory . '/src/Routes.php';
	}

	public function toString(): string
	{
		return $this->routesFile;
	}
}