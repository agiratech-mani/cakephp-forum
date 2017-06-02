<?php
namespace AgiraForum\Test\TestCase\Model\Table;

use AgiraForum\Model\Table\ForumCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AgiraForum\Model\Table\ForumCategoriesTable Test Case
 */
class ForumCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \AgiraForum\Model\Table\ForumCategoriesTable
     */
    public $ForumCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.agira_forum.forum_categories',
        'plugin.agira_forum.forum_topics'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ForumCategories') ? [] : ['className' => 'AgiraForum\Model\Table\ForumCategoriesTable'];
        $this->ForumCategories = TableRegistry::get('ForumCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ForumCategories);

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
}
