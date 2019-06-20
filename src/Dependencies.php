<?php declare(strict_types=1);

use Auryn\Injector;
use SocialNews\Framework\Rendering\TemplateRenderer;
use SocialNews\Framework\Rendering\TwigTemplateRendererFactory;
use SocialNews\Framework\Rendering\TemplateDirectory;

use SocialNews\FrontPage\Application\SubmissionsQuery;
use SocialNews\FrontPage\Infrastructure\DbalSubmissionsQuery;

use Doctrine\DBAL\Connection;
use SocialNews\Framework\Dbal\ConnectionFactory;
use SocialNews\Framework\Dbal\DatabaseUrl;

use SocialNews\Framework\Csrf\TokenStorage;
use SocialNews\Framework\Csrf\SymfonySessionTokenStorage;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;

use SocialNews\Submission\Domain\SubmissionRepository;
use SocialNews\Submission\Infrastructure\DbalSubmissionRepository;

use SocialNews\User\Domain\UserRepository;
use SocialNews\User\Infrastructure\DbalUserRepository;

use SocialNews\User\Application\NicknameTakenQuery;
use SocialNews\User\Infrastructure\DbalNicknameTakenQuery;


$injector = new Injector();

//Déclaration des factories
$injector->delegate(
	TemplateRenderer::class,
	function () use ($injector): TemplateRenderer {
		$factory = $injector->make(TwigTemplateRendererFactory::class);
		return $factory->create();
	}
);
$injector->delegate(
	Connection::class,
	function () use ($injector): Connection {
		$factory = $injector->make(ConnectionFactory::class);
		return $factory->create();
	}
);

//permet de s'assurer que l'instance de la classe sera réutilisée plutôt que ré-instanciée à chaque injection. (Plus secure que le singleton)
$injector->share(Connection::class);

//Déclaration des classes sans factory ayant besoin de params dans le construct
$injector->define(
	TemplateDirectory::class,
	[':rootDirectory' => ROOT_DIR]
);
$injector->define(
	DatabaseUrl::class,
	[':url' => 'sqlite:///' . ROOT_DIR . '/storage/db.sqlite3']
);

//Correspondance entre une interface et une classe
$injector->alias(SubmissionsQuery::class, DbalSubmissionsQuery::class);

$injector->alias(TokenStorage::class, SymfonySessionTokenStorage::class);

$injector->alias(SessionInterface::class, Session::class);

$injector->alias(SubmissionRepository::class, DbalSubmissionRepository::class);

$injector->alias(UserRepository::class, DbalUserRepository::class);

$injector->alias(NicknameTakenQuery::class, DbalNicknameTakenQuery::class);

//empêche le DI de créer une nouvelle instance à chaque fois que l'objet est injecté. La même instance est utilisée pour toutes les classes utilisant cette dépendance.
$injector->share(SubmissionsQuery::class);

return $injector;