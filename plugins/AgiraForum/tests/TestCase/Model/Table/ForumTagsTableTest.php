<?php
namespace AgiraForum\Test\TestCase\Model\Table;

use AgiraForum\Model\Table\ForumTagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AgiraForum\Model\Table\ForumTagsTable Test Case
 */
class ForumTagsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \AgiraForum\Model\Table\ForumTagsTable
     */
    public $ForumTags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('ForumTags') ? [] : ['className' => 'AgiraForum\Model\Table\ForumTagsTable'];
        $this->ForumTags = TableRegistry::get('ForumTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumTags);

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
