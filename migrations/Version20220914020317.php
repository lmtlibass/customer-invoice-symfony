<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220914020317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice_line DROP FOREIGN KEY FK_D3D1D693429ECEE2');
        $this->addSql('DROP INDEX UNIQ_D3D1D693429ECEE2 ON invoice_line');
        $this->addSql('ALTER TABLE invoice_line ADD quantity INT NOT NULL, CHANGE invoice_id_id invoice_id INT NOT NULL');
        $this->addSql('ALTER TABLE invoice_line ADD CONSTRAINT FK_D3D1D6932989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D3D1D6932989F1FD ON invoice_line (invoice_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice_line DROP FOREIGN KEY FK_D3D1D6932989F1FD');
        $this->addSql('DROP INDEX UNIQ_D3D1D6932989F1FD ON invoice_line');
        $this->addSql('ALTER TABLE invoice_line ADD invoice_id_id INT NOT NULL, DROP invoice_id, DROP quantity');
        $this->addSql('ALTER TABLE invoice_line ADD CONSTRAINT FK_D3D1D693429ECEE2 FOREIGN KEY (invoice_id_id) REFERENCES invoice (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D3D1D693429ECEE2 ON invoice_line (invoice_id_id)');
    }
}
