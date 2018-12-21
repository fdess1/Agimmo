<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181219151242 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE app_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_88BDF3E992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_88BDF3E9A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_88BDF3E9C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse CHANGE ad_cl_id ad_cl_id SMALLINT UNSIGNED DEFAULT NULL COMMENT \'pk client\'');
        $this->addSql('ALTER TABLE appel_fonds CHANGE af_bn_id af_bn_id SMALLINT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE bail CHANGE bl_id_bien bl_id_bien SMALLINT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE bien CHANGE bn_id_proprio bn_id_proprio SMALLINT UNSIGNED DEFAULT NULL COMMENT \'pk client\', CHANGE photo photo VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE depense CHANGE dp_bl_id dp_bl_id SMALLINT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE locs_bail CHANGE lc_bl_id lc_bl_id SMALLINT UNSIGNED DEFAULT NULL, CHANGE lc_cl_id lc_cl_id SMALLINT UNSIGNED DEFAULT NULL COMMENT \'pk client\'');
        $this->addSql('ALTER TABLE loyer CHANGE ly_bl_id ly_bl_id SMALLINT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE scan_pieces CHANGE sp_bl_id sp_bl_id SMALLINT UNSIGNED DEFAULT NULL, CHANGE sp_dp_id sp_dp_id SMALLINT UNSIGNED DEFAULT NULL, CHANGE sp_af_id sp_af_id SMALLINT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE tom CHANGE tom_sp_id tom_sp_id SMALLINT UNSIGNED DEFAULT NULL, CHANGE tom_bn_id tom_bn_id SMALLINT UNSIGNED DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE app_user');
        $this->addSql('ALTER TABLE adresse CHANGE ad_cl_id ad_cl_id SMALLINT UNSIGNED DEFAULT NULL COMMENT \'fk -> client\'');
        $this->addSql('ALTER TABLE appel_fonds CHANGE af_bn_id af_bn_id SMALLINT UNSIGNED NOT NULL COMMENT \'bien de reference : fk -> bien\'');
        $this->addSql('ALTER TABLE bail CHANGE bl_id_bien bl_id_bien SMALLINT UNSIGNED DEFAULT NULL COMMENT \'fk->bien\'');
        $this->addSql('ALTER TABLE bien CHANGE bn_id_proprio bn_id_proprio SMALLINT UNSIGNED DEFAULT NULL, CHANGE photo photo VARCHAR(50) DEFAULT NULL COLLATE utf8_general_ci COMMENT \'Nom du fichier de la photo si existante\'');
        $this->addSql('ALTER TABLE depense CHANGE dp_bl_id dp_bl_id SMALLINT UNSIGNED NOT NULL COMMENT \'bail de reference : fk -> bail\'');
        $this->addSql('ALTER TABLE locs_bail CHANGE lc_cl_id lc_cl_id SMALLINT UNSIGNED NOT NULL COMMENT \'le client (co)locataire\', CHANGE lc_bl_id lc_bl_id SMALLINT UNSIGNED NOT NULL COMMENT \'le bail de reference\'');
        $this->addSql('ALTER TABLE loyer CHANGE ly_bl_id ly_bl_id SMALLINT UNSIGNED NOT NULL COMMENT \'bail de reference : fk -> bail\'');
        $this->addSql('ALTER TABLE scan_pieces CHANGE sp_af_id sp_af_id SMALLINT UNSIGNED DEFAULT NULL COMMENT \' appel de fonds de reference\', CHANGE sp_bl_id sp_bl_id SMALLINT UNSIGNED NOT NULL COMMENT \' bail de reference\', CHANGE sp_dp_id sp_dp_id SMALLINT UNSIGNED DEFAULT NULL COMMENT \' depense de reference\'');
        $this->addSql('ALTER TABLE tom CHANGE tom_sp_id tom_sp_id SMALLINT UNSIGNED DEFAULT NULL COMMENT \' lien vers scan eventuel\', CHANGE tom_bn_id tom_bn_id SMALLINT UNSIGNED NOT NULL COMMENT \' lien vers bien\'');
    }
}
