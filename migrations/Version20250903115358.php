<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250903115358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_message ADD relation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact_message ADD CONSTRAINT FK_2C9211FE3256915B FOREIGN KEY (relation_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2C9211FE3256915B ON contact_message (relation_id)');
        $this->addSql('ALTER TABLE patient ADD relation_id INT NOT NULL, ADD first_name VARCHAR(255) NOT NULL, ADD last_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB3256915B FOREIGN KEY (relation_id) REFERENCES appointment (id)');
        $this->addSql('CREATE INDEX IDX_1ADAD7EB3256915B ON patient (relation_id)');
        $this->addSql('ALTER TABLE testimonial ADD relation_id INT NOT NULL');
        $this->addSql('ALTER TABLE testimonial ADD CONSTRAINT FK_E6BDCDF73256915B FOREIGN KEY (relation_id) REFERENCES patient (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E6BDCDF73256915B ON testimonial (relation_id)');
        $this->addSql('ALTER TABLE user ADD appointment_id INT DEFAULT NULL, ADD page_id INT DEFAULT NULL, ADD first_name VARCHAR(255) NOT NULL, ADD last_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E5B533F9 FOREIGN KEY (appointment_id) REFERENCES appointment (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C4663E4 FOREIGN KEY (page_id) REFERENCES page (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649E5B533F9 ON user (appointment_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649C4663E4 ON user (page_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EB3256915B');
        $this->addSql('DROP INDEX IDX_1ADAD7EB3256915B ON patient');
        $this->addSql('ALTER TABLE patient DROP relation_id, DROP first_name, DROP last_name');
        $this->addSql('ALTER TABLE contact_message DROP FOREIGN KEY FK_2C9211FE3256915B');
        $this->addSql('DROP INDEX UNIQ_2C9211FE3256915B ON contact_message');
        $this->addSql('ALTER TABLE contact_message DROP relation_id');
        $this->addSql('ALTER TABLE testimonial DROP FOREIGN KEY FK_E6BDCDF73256915B');
        $this->addSql('DROP INDEX UNIQ_E6BDCDF73256915B ON testimonial');
        $this->addSql('ALTER TABLE testimonial DROP relation_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E5B533F9');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C4663E4');
        $this->addSql('DROP INDEX IDX_8D93D649E5B533F9 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649C4663E4 ON user');
        $this->addSql('ALTER TABLE user DROP appointment_id, DROP page_id, DROP first_name, DROP last_name');
    }
}
