<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261124145331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, game_date DATETIME NOT NULL, number_try INT NOT NULL, score INT NOT NULL, victory TINYINT NOT NULL, difficulty VARCHAR(50) NOT NULL, player_id INT NOT NULL, mode_id INT NOT NULL, pokemon_id INT NOT NULL, INDEX IDX_232B318C99E6F5DF (player_id), INDEX IDX_232B318C77E5854A (mode_id), INDEX IDX_232B318C2FE71C3E (pokemon_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE generation (id INT AUTO_INCREMENT NOT NULL, number INT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE hint (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, cost INT NOT NULL, type_hint VARCHAR(50) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE mode (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, type_mode VARCHAR(50) NOT NULL, daily_limit INT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE pokemon (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(50) NOT NULL, height NUMERIC(5, 2) NOT NULL, weight NUMERIC(6, 2) NOT NULL, evolution_stage INT NOT NULL, image VARCHAR(500) DEFAULT NULL, card_image VARCHAR(500) DEFAULT NULL, habitat VARCHAR(100) DEFAULT NULL, generation_id INT NOT NULL, INDEX IDX_62DC90F3553A6EC4 (generation_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE pokemon_pokemon_type (pokemon_id INT NOT NULL, pokemon_type_id INT NOT NULL, INDEX IDX_F1F052B32FE71C3E (pokemon_id), INDEX IDX_F1F052B3A926F002 (pokemon_type_id), PRIMARY KEY (pokemon_id, pokemon_type_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE pokemon_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE proposition (id INT AUTO_INCREMENT NOT NULL, number_try INT NOT NULL, game_id INT NOT NULL, pokemon_id INT NOT NULL, INDEX IDX_C7CDC353E48FD905 (game_id), INDEX IDX_C7CDC3532FE71C3E (pokemon_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(50) NOT NULL, email VARCHAR(91) NOT NULL, password VARCHAR(255) NOT NULL, inscription_date DATETIME NOT NULL, `admin` TINYINT NOT NULL, experience INT NOT NULL, money INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user_hint (id INT AUTO_INCREMENT NOT NULL, use_data DATETIME NOT NULL, cost_paid INT NOT NULL, hint_id INT NOT NULL, player_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_4E474F9A519161AB (hint_id), INDEX IDX_4E474F9A99E6F5DF (player_id), INDEX IDX_4E474F9AE48FD905 (game_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C99E6F5DF FOREIGN KEY (player_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C77E5854A FOREIGN KEY (mode_id) REFERENCES mode (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C2FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id)');
        $this->addSql('ALTER TABLE pokemon ADD CONSTRAINT FK_62DC90F3553A6EC4 FOREIGN KEY (generation_id) REFERENCES generation (id)');
        $this->addSql('ALTER TABLE pokemon_pokemon_type ADD CONSTRAINT FK_F1F052B32FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pokemon_pokemon_type ADD CONSTRAINT FK_F1F052B3A926F002 FOREIGN KEY (pokemon_type_id) REFERENCES pokemon_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE proposition ADD CONSTRAINT FK_C7CDC353E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE proposition ADD CONSTRAINT FK_C7CDC3532FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id)');
        $this->addSql('ALTER TABLE user_hint ADD CONSTRAINT FK_4E474F9A519161AB FOREIGN KEY (hint_id) REFERENCES hint (id)');
        $this->addSql('ALTER TABLE user_hint ADD CONSTRAINT FK_4E474F9A99E6F5DF FOREIGN KEY (player_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_hint ADD CONSTRAINT FK_4E474F9AE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C99E6F5DF');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C77E5854A');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C2FE71C3E');
        $this->addSql('ALTER TABLE pokemon DROP FOREIGN KEY FK_62DC90F3553A6EC4');
        $this->addSql('ALTER TABLE pokemon_pokemon_type DROP FOREIGN KEY FK_F1F052B32FE71C3E');
        $this->addSql('ALTER TABLE pokemon_pokemon_type DROP FOREIGN KEY FK_F1F052B3A926F002');
        $this->addSql('ALTER TABLE proposition DROP FOREIGN KEY FK_C7CDC353E48FD905');
        $this->addSql('ALTER TABLE proposition DROP FOREIGN KEY FK_C7CDC3532FE71C3E');
        $this->addSql('ALTER TABLE user_hint DROP FOREIGN KEY FK_4E474F9A519161AB');
        $this->addSql('ALTER TABLE user_hint DROP FOREIGN KEY FK_4E474F9A99E6F5DF');
        $this->addSql('ALTER TABLE user_hint DROP FOREIGN KEY FK_4E474F9AE48FD905');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE generation');
        $this->addSql('DROP TABLE hint');
        $this->addSql('DROP TABLE mode');
        $this->addSql('DROP TABLE pokemon');
        $this->addSql('DROP TABLE pokemon_pokemon_type');
        $this->addSql('DROP TABLE pokemon_type');
        $this->addSql('DROP TABLE proposition');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_hint');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
