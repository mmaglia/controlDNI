<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200422150250 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE black_list_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE controlado_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE lista_control_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE black_list (id INT NOT NULL, lista_control_id INT NOT NULL, controlado_id INT DEFAULT NULL, dni INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_972CB851235261E7 ON black_list (lista_control_id)');
        $this->addSql('CREATE INDEX IDX_972CB851D55C1267 ON black_list (controlado_id)');
        $this->addSql('CREATE TABLE controlado (id INT NOT NULL, dni INT NOT NULL, fecha DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE lista_control (id INT NOT NULL, fecha DATE NOT NULL, descripcion VARCHAR(120) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE black_list ADD CONSTRAINT FK_972CB851235261E7 FOREIGN KEY (lista_control_id) REFERENCES lista_control (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE black_list ADD CONSTRAINT FK_972CB851D55C1267 FOREIGN KEY (controlado_id) REFERENCES controlado (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE black_list DROP CONSTRAINT FK_972CB851D55C1267');
        $this->addSql('ALTER TABLE black_list DROP CONSTRAINT FK_972CB851235261E7');
        $this->addSql('DROP SEQUENCE black_list_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE controlado_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE lista_control_id_seq CASCADE');
        $this->addSql('DROP TABLE black_list');
        $this->addSql('DROP TABLE controlado');
        $this->addSql('DROP TABLE lista_control');
    }
}
