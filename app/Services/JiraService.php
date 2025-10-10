<?php

namespace App\Services;

use DH\Adf\Node\Block\Document;
use JiraCloud\ADF\AtlassianDocumentFormat;
use JiraCloud\Issue\IssueField;
use JiraCloud\Issue\IssueService;

class JiraService
{
    public string $projectKey;
    public string $summary;

    public function __construct(
        public IssueService $issueService,
    )
    {
    }

    public function setProjectKey(string $projectKey): self
    {
        $this->projectKey = $projectKey;
        return $this;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;
        return $this;
    }

    public function createIssue(Document $doc, string $issueType = 'Task')
    {
        $field = new IssueField();
        $desc = new AtlassianDocumentFormat($doc);

        $field
            ->setProjectKey($this->projectKey)
            ->setSummary($this->summary)
            ->setIssueTypeAsString('Task')
            ->setDescription($desc);

        $res = $this->issueService->create($field);
    }
}
