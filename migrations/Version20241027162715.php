<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241027162715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comentario (id INT IDENTITY NOT NULL, comentario NVARCHAR(3000) NOT NULL, id_usuario INT NOT NULL, id_media INT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE empresa (id INT IDENTITY NOT NULL, nombre NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE empresa_media (id INT IDENTITY NOT NULL, id_empresa INT NOT NULL, id_media INT NOT NULL, id_tipo_aporte INT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE genero (id INT IDENTITY NOT NULL, genero NVARCHAR(100) NOT NULL, tipo_media INT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE genero_media (id INT IDENTITY NOT NULL, id_genero INT NOT NULL, id_media INT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE lista_media (id INT IDENTITY NOT NULL, id_usuario INT NOT NULL, id_media INT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE media (id INT IDENTITY NOT NULL, titulo NVARCHAR(255) NOT NULL, titulo_original NVARCHAR(255) NOT NULL, id_tipo_media INT NOT NULL, id_precuela INT, id_secuela INT, fecha_estreno DATETIME2(6) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE persona (id INT IDENTITY NOT NULL, nombre NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE persona_media (id INT IDENTITY NOT NULL, id_persona INT NOT NULL, id_media INT NOT NULL, id_tipo_aporte INT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE tipo_aporte (id INT IDENTITY NOT NULL, tipo_aporte NVARCHAR(100) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE tipo_media (id INT IDENTITY NOT NULL, tipo_media NVARCHAR(100) NOT NULL, PRIMARY KEY (id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA db_accessadmin');
        $this->addSql('CREATE SCHEMA db_backupoperator');
        $this->addSql('CREATE SCHEMA db_datareader');
        $this->addSql('CREATE SCHEMA db_datawriter');
        $this->addSql('CREATE SCHEMA db_ddladmin');
        $this->addSql('CREATE SCHEMA db_denydatareader');
        $this->addSql('CREATE SCHEMA db_denydatawriter');
        $this->addSql('CREATE SCHEMA db_owner');
        $this->addSql('CREATE SCHEMA db_securityadmin');
        $this->addSql('CREATE SCHEMA dbo');
        $this->addSql('DROP TABLE comentario');
        $this->addSql('DROP TABLE empresa');
        $this->addSql('DROP TABLE empresa_media');
        $this->addSql('DROP TABLE genero');
        $this->addSql('DROP TABLE genero_media');
        $this->addSql('DROP TABLE lista_media');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE persona');
        $this->addSql('DROP TABLE persona_media');
        $this->addSql('DROP TABLE tipo_aporte');
        $this->addSql('DROP TABLE tipo_media');
    }
}
