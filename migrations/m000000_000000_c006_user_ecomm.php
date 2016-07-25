<?php
use yii\db\Migration;

class m000000_000000_c006_user_ecomm extends Migration
{

    /**
     *
     */
    public function up()
    {

        self::down();

        $tables = Yii::$app->db->schema->getTableNames();
        $dbType = $this->db->driverName;
        $tableOptions_mysql = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB";
        $tableOptions_mssql = "";
        $tableOptions_pgsql = "";
        $tableOptions_sqlite = "";

        /* MYSQL */
        if (!in_array('preferences', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%preferences}}', [
                    'id'       => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0          => 'PRIMARY KEY (`id`)',
                    'key'      => 'VARCHAR(45) NOT NULL',
                    'value'    => 'VARCHAR(100) NULL',
                    'editable' => 'TINYINT(1) NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('user', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%user}}', [
                    'id'                   => 'INT(11) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0                      => 'PRIMARY KEY (`id`)',
                    'network_id'           => 'INT(10) UNSIGNED NOT NULL',
                    'store_id'             => 'INT(10) UNSIGNED NOT NULL',
                    'username'             => 'VARCHAR(255) NOT NULL',
                    'auth_key'             => 'VARCHAR(32) NOT NULL',
                    'password_hash'        => 'VARCHAR(255) NOT NULL',
                    'password_reset_token' => 'VARCHAR(255) NULL',
                    'email'                => 'VARCHAR(255) NOT NULL',
                    'role'                 => 'SMALLINT(6) NOT NULL DEFAULT \'10\'',
                    'status'               => 'SMALLINT(6) NOT NULL DEFAULT \'10\'',
                    'created_at'           => 'TIMESTAMP NULL',
                    'updated_at'           => 'TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ',
                    'phone'                => 'VARCHAR(14) NULL',
                    'phone_sms'            => 'VARCHAR(50) NULL',
                    'phone_mms'            => 'VARCHAR(50) NULL',
                    'phone_carrier_id'     => 'SMALLINT(5) UNSIGNED DEFAULT \'1\'',
                    'first_name'           => 'VARCHAR(45) NOT NULL',
                    'last_name'            => 'VARCHAR(45) NOT NULL',
                    'pin'                  => 'CHAR(32) NULL',
                    'pin_tries'            => 'TINYINT(1) NULL DEFAULT \'2\'',
                    'confirmed'            => 'TINYINT(1) UNSIGNED NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('user_billing', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%user_billing}}', [
                    'id'          => 'BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0             => 'PRIMARY KEY (`id`)',
                    'network_id'  => 'INT(10) UNSIGNED NOT NULL',
                    'store_id'    => 'INT(10) UNSIGNED NOT NULL',
                    'user_id'     => 'INT(10) UNSIGNED NOT NULL',
                    'name'        => 'VARCHAR(100) NOT NULL',
                    'exp_month'   => 'TINYINT(2) NOT NULL',
                    'exp_year'    => 'TINYINT(4) NOT NULL',
                    'postal_code' => 'VARCHAR(18) NOT NULL',
                    'default'     => 'TINYINT(1) UNSIGNED NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('user_notification', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%user_notification}}', [
                    'id'                   => 'BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0                      => 'PRIMARY KEY (`id`)',
                    'notification_type_id' => 'SMALLINT(5) UNSIGNED NOT NULL',
                    'network_id'           => 'INT(10) UNSIGNED NOT NULL',
                    'store_id'             => 'INT(10) UNSIGNED NOT NULL',
                    'user_id'              => 'INT(10) UNSIGNED NOT NULL',
                    'message'              => 'TEXT NOT NULL',
                    'timestamp'            => 'INT(10) UNSIGNED NOT NULL',
                    'read'                 => 'TINYINT(1) UNSIGNED NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('user_notification_type', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%user_notification_type}}', [
                    'id'   => 'SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0      => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(100) NOT NULL',
                    'css'  => 'VARCHAR(45) NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('user_roles', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%user_roles}}', [
                    'id'    => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0       => 'PRIMARY KEY (`id`)',
                    'name'  => 'VARCHAR(100) NOT NULL',
                    'level' => 'SMALLINT(6) NOT NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('user_roles_link', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%user_roles_link}}', [
                    'id'            => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0               => 'PRIMARY KEY (`id`)',
                    'user_id'       => 'INT(10) UNSIGNED NOT NULL',
                    'user_roles_id' => 'INT(10) UNSIGNED NOT NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('user_shipping', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%user_shipping}}', [
                    'id'             => 'BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0                => 'PRIMARY KEY (`id`)',
                    'network_id'     => 'INT(10) UNSIGNED NOT NULL',
                    'store_id'       => 'INT(10) UNSIGNED NOT NULL',
                    'user_id'        => 'INT(10) UNSIGNED NOT NULL',
                    'name'           => 'VARCHAR(100) NOT NULL',
                    'address'        => 'VARCHAR(100) NOT NULL',
                    'address_apt'    => 'VARCHAR(45) NULL',
                    'city_id'        => 'SMALLINT(5) UNSIGNED NOT NULL',
                    'state_id'       => 'SMALLINT(5) UNSIGNED NOT NULL',
                    'postal_code_id' => 'INT(10) UNSIGNED NOT NULL',
                    'country_id'     => 'SMALLINT(5) UNSIGNED NOT NULL',
                    'default'        => 'TINYINT(1) UNSIGNED NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('user_transaction', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%user_transaction}}', [
                    'id'                  => 'BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0                     => 'PRIMARY KEY (`id`)',
                    'network_id'          => 'INT(10) UNSIGNED NOT NULL',
                    'store_id'            => 'INT(10) UNSIGNED NOT NULL',
                    'user_id'             => 'INT(10) UNSIGNED NOT NULL',
                    'transaction_type_id' => 'TINYINT(2) UNSIGNED NOT NULL',
                    'amount'              => 'DECIMAL(12,2) NOT NULL',
                    'transaction_id'      => 'CHAR(30) NOT NULL',
                    'ledger'              => 'VARCHAR(200) NULL',
                    'timestamp'           => 'INT(11) NOT NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('user_transaction_details', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%user_transaction_details}}', [
                    'id'             => 'BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0                => 'PRIMARY KEY (`id`)',
                    'transaction_id' => 'CHAR(30) NOT NULL',
                    'key'            => 'VARCHAR(30) NOT NULL',
                    'value'          => 'VARCHAR(200) NOT NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('user_transaction_type', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%user_transaction_type}}', [
                    'id'   => 'SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0      => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(100) NOT NULL',
                    'css'  => 'VARCHAR(30) NOT NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('phone_carriers', $tables)) {
            if ($dbType == "mysql") {
                $this->createTable('{{%phone_carriers}}', [
                    'id'   => 'SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT',
                    0      => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(100) NOT NULL',
                ], $tableOptions_mysql);
            }
        }

        $this->createIndex('idx_UNIQUE_email_8405_00', 'user', 'email', 1);
        $this->createIndex('idx_network_id_8405_01', 'user', 'network_id', 0);
        $this->createIndex('idx_store_id_8405_02', 'user', 'store_id', 0);
        $this->createIndex('idx_phone_carrier_id_8405_03', 'user', 'phone_carrier_id', 0);
        $this->createIndex('idx_user_id_8473_04', 'user_billing', 'user_id', 0);
        $this->createIndex('idx_network_id_8473_05', 'user_billing', 'network_id', 0);
        $this->createIndex('idx_store_id_8473_06', 'user_billing', 'store_id', 0);
        $this->createIndex('idx_notification_type_id_8551_07', 'user_notification', 'notification_type_id', 0);
        $this->createIndex('idx_user_id_8552_08', 'user_notification', 'user_id', 0);
        $this->createIndex('idx_network_id_8552_09', 'user_notification', 'network_id', 0);
        $this->createIndex('idx_store_id_8552_10', 'user_notification', 'store_id', 0);
        $this->createIndex('idx_UNIQUE_name_8593_11', 'user_roles', 'name', 1);
        $this->createIndex('idx_user_id_8612_12', 'user_roles_link', 'user_id', 0);
        $this->createIndex('idx_user_id_864_13', 'user_shipping', 'user_id', 0);
        $this->createIndex('idx_city_id_8641_14', 'user_shipping', 'city_id', 0);
        $this->createIndex('idx_state_id_8641_15', 'user_shipping', 'state_id', 0);
        $this->createIndex('idx_postal_code_id_8641_16', 'user_shipping', 'postal_code_id', 0);
        $this->createIndex('idx_country_id_8641_17', 'user_shipping', 'country_id', 0);
        $this->createIndex('idx_network_id_8641_18', 'user_shipping', 'network_id', 0);
        $this->createIndex('idx_store_id_8641_19', 'user_shipping', 'store_id', 0);
        $this->createIndex('idx_user_id_8666_20', 'user_transaction', 'user_id', 0);
        $this->createIndex('idx_transaction_id_8666_21', 'user_transaction', 'transaction_id', 0);
        $this->createIndex('idx_network_id_8666_22', 'user_transaction', 'network_id', 0);
        $this->createIndex('idx_store_id_8666_23', 'user_transaction', 'store_id', 0);

        $this->execute('SET foreign_key_checks = 0');
        $this->addForeignKey('fk_phone_carriers_84_00', '{{%user}}', 'phone_carrier_id', '{{%phone_carriers}}', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk_user_843_01', '{{%user_billing}}', 'store_id', '{{%user}}', 'store_id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk_user_843_02', '{{%user_billing}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk_user_843_03', '{{%user_billing}}', 'network_id', '{{%user}}', 'network_id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk_user_notification_type_8547_04', '{{%user_notification}}', 'notification_type_id', '{{%user_notification_type}}', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk_user_8547_05', '{{%user_notification}}', 'store_id', '{{%user}}', 'store_id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk_user_8547_06', '{{%user_notification}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk_user_8547_07', '{{%user_notification}}', 'network_id', '{{%user}}', 'network_id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk_user_8608_08', '{{%user_roles_link}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk_user_8636_09', '{{%user_shipping}}', 'network_id', '{{%user}}', 'network_id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk_user_8636_010', '{{%user_shipping}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk_user_8636_011', '{{%user_shipping}}', 'store_id', '{{%user}}', 'store_id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk_user_8662_012', '{{%user_transaction}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk_user_8662_013', '{{%user_transaction}}', 'network_id', '{{%user}}', 'network_id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('fk_user_8662_014', '{{%user_transaction}}', 'store_id', '{{%user}}', 'store_id', 'CASCADE', 'NO ACTION');
        $this->execute('SET foreign_key_checks = 1;');

        $this->execute('SET foreign_key_checks = 0');
        $this->insert('{{%user}}', ['id' => '1', 'network_id' => '1', 'store_id' => '1', 'username' => 'admin', 'auth_key' => 'CcqfH1ZuHo-HxdM-DK3yX4d0Z9SyNWUq', 'password_hash' => '$2y$13$E2Cedx.IWufS03d6IgGe..TwDYZxTz1WpNi7/65ZqghlLr5nHXgvS', 'password_reset_token' => '', 'email' => 'jchambers.dev@gmail.com', 'role' => '10', 'status' => '10', 'created_at' => '0000-00-00 00:00:00', 'updated_at' => '2015-09-14 08:04:04', 'phone' => '', 'phone_sms' => '0', 'phone_mms' => '', 'phone_carrier_id' => '1', 'first_name' => 'user', 'last_name' => 'admin', 'pin' => '', 'pin_tries' => '2', 'confirmed' => '1']);
        $this->insert('{{%user_notification_type}}', ['id' => '1', 'name' => 'Friend Request', 'css' => 'bg-blue']);
        $this->insert('{{%user_notification_type}}', ['id' => '2', 'name' => 'Loan Request', 'css' => 'bg-green']);
        $this->insert('{{%user_notification_type}}', ['id' => '3', 'name' => 'Funds Transfer', 'css' => 'bg-green']);
        $this->insert('{{%user_notification_type}}', ['id' => '4', 'name' => 'Loan Reminder', 'css' => 'bg-yellow']);
        $this->insert('{{%user_notification_type}}', ['id' => '5', 'name' => 'Payment Recieved', 'css' => 'bg-green']);
        $this->insert('{{%user_roles}}', ['id' => '1', 'name' => 'Admin', 'level' => '100']);
        $this->insert('{{%user_roles}}', ['id' => '2', 'name' => 'User', 'level' => '10']);
        $this->insert('{{%user_transaction_type}}', ['id' => '1', 'name' => 'Purchase', 'css' => 'bg-red']);
        $this->insert('{{%user_transaction_type}}', ['id' => '2', 'name' => 'Refund', 'css' => 'bg-green']);
        $this->insert('{{%user_transaction_type}}', ['id' => '3', 'name' => 'Cancel', 'css' => 'bg-yellow']);
        $this->execute('SET foreign_key_checks = 1;');

        $this->execute('SET foreign_key_checks = 0');
        $this->insert('{{%phone_carriers}}', ['id' => '1', 'name' => 'None']);
        $this->insert('{{%phone_carriers}}', ['id' => '2', 'name' => 'Verizon Wireless']);
        $this->execute('SET foreign_key_checks = 1;');

    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `preferences`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `user`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `user_billing`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `user_notification`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `user_notification_type`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `user_roles`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `user_roles_link`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `user_shipping`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `user_transaction`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `user_transaction_details`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `user_transaction_type`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `phone_carriers`');
        $this->execute('SET foreign_key_checks = 1;');

    }
}

