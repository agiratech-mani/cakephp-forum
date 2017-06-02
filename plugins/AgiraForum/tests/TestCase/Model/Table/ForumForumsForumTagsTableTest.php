<?php
namespace AgiraForum\Test\TestCase\Model\Table;

use AgiraForum\Model\Table\ForumForumsForumTagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AgiraForum\Model\Table\ForumForumsForumTagsTable Test Case
 */
class ForumForumsForumTagsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \AgiraForum\Model\Table\ForumForumsForumTagsTable
     */
    public $ForumForumsForumTags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.agira_forum.forum_forums_forum_tags',
        'plugin.agira_forum.forum_forums',
        'plugin.agira_forum.forum_topics',
        'plugin.agira_forum.forum_categories',
        'plugin.agira_forum.users',
        'plugin.agira_forum.forum_posts',
        'plugin.agira_forum.forum_tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ForumForumsForumTags') ? [] : ['className' => 'AgiraForum\Model\Table\ForumForumsForumTagsTable'];
        $this->ForumForumsForumTags = TableRegistry::get('ForumForumsForumTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumForumsForumTags);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
