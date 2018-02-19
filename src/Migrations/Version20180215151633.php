<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180215151633 extends AbstractMigration
{
    private $table = 'categories';

    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $table = $schema->createTable($this->table);
        $table->addColumn('id', 'integer', [
            'autoincrement' => true,
        ]);
        $table->setPrimaryKey(['id']);

        $table->addColumn('name', 'string', [
            'length' => '50'
        ]);
        $table->addColumn('description', 'string', [
            'length' => '255',
            'notnull' => false
        ]);
        $table->addColumn('created_at', 'datetime', [
            'notnull' => false
        ]);
        $table->addColumn('updated_at', 'datetime', [
            'notnull' => false
        ]);
        $table->addColumn('deleted_at', 'datetime', [
            'notnull' => false
        ]);
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $schema->dropTable($this->table);
    }
}
