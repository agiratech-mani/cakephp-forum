<?php
namespace AgiraForum\Test\TestCase\Model\Table;

use AgiraForum\Model\Table\ForumForumsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AgiraForum\Model\Table\ForumForumsTable Test Case
 */
class ForumForumsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \AgiraForum\Model\Table\ForumForumsTable
     */
    public $ForumForums;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.agira_forum.forum_forums',
        'plugin.agira_forum.forum_topics',
        'plugin.agira_forum.forum_categories',
        'plugin.agira_forum.users',
        'plugin.agira_forum.forum_posts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ForumForums') ? [] : ['className' => 'AgiraForum\Model\Table\ForumForumsTable'];
        $this->ForumForums = TableRegistry::get('ForumForums', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumForums);

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
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
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
