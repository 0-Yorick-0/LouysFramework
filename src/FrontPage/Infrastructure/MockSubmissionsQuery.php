<?php declare(strict_types=1);

namespace SocialNews\FrontPage\Infrastructure;

use SocialNews\FrontPage\Application\Submission;
use SocialNews\FrontPage\Application\SubmissionsQuery;

/**
 * 
 */
final class MockSubmissionsQuery implements SubmissionsQuery
{
	
	function __construct()
	{
		$this->submissions = [
			new Submission('https://duckduckgo.com', 'DuckDuckGo'),
			new Submission('https://elgoog.com', 'Elgoog'),
			new Submission('https://qwant.com', 'Qwant'),
		];
	}

	public function execute(): array
	{
		return $this->submissions;
	}
}