<?php declare(strict_types=1);

namespace SocialNews\Framework\Rbac;

use Ramsey\Uuid\UuidInterface;

final class AuthenticatedUser implements User
{
	private $id;
	private $roles = [];
	/**
	 * @param  Role[] $roles
	 */
	public function __construct(UuidInterface $id, array $role)
	{
		$this->id = $id;
		$this->roles = $roles;
	}

	public function getId(): UuidInterface
	{
		return $this->id;
	}

	public function hasPermisssions(Permission $permission): bool
	{
		foreach ($this->role as $role) {
			if ($role->hasPermisssions($permission)) {
				return true;
			}
		}
		return false;
	}
}