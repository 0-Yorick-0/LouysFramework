<?php declare(strict_types=1);

namespace SocialNews\FrontPage\Presentation;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use SocialNews\Framework\Rendering\TemplateRenderer;

final class FrontPageController
{
	private $templateRenderer;

	public function __construct(TemplateRenderer $templateRenderer)
	{
		$this->templateRenderer = $templateRenderer;
	}

	public function show(Request $request): Response
	{
		$submissions = [
			['url' => 'http://qwant.com', 'title' => 'Qwant'],
			['url' => 'http://google.com', 'title' => 'Evil for dummies<script>alert("Damned")</script>'],
		];

		$content = $this->templateRenderer->render(
			'FrontPage.html.twig',
			['submissions' => $submissions
		]);
		return new Response($content);
	}
}