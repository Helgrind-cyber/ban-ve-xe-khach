-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- CREATE TABLE "news" -----------------------------------------
CREATE TABLE `news`( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`image` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`title` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`content` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 11;
-- -------------------------------------------------------------


-- CREATE TABLE "order_detail" ---------------------------------
CREATE TABLE `order_detail`( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`order_id` Int( 11 ) NOT NULL,
	`unit_price` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	`seat_number` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	`quantity` Int( 11 ) NOT NULL,
	`schedule_id` Int( 11 ) NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------


-- CREATE TABLE "orders" ---------------------------------------
CREATE TABLE `orders`( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`user_id` Int( 11 ) NOT NULL,
	`created_date` DateTime NOT NULL,
	`status` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------


-- CREATE TABLE "roles" ----------------------------------------
CREATE TABLE `roles`( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`name` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	`status` Int( 1 ) NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 4;
-- -------------------------------------------------------------


-- CREATE TABLE "route_schedules" ------------------------------
CREATE TABLE `route_schedules`( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`route_id` Int( 11 ) NOT NULL,
	`vehicle_id` Int( 11 ) NOT NULL,
	`price` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	`start_time` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	`end_time` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 10;
-- -------------------------------------------------------------


-- CREATE TABLE "routes" ---------------------------------------
CREATE TABLE `routes`( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`distance` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	`estimate_time` Time NOT NULL,
	`begin_point` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	`end_point` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 3;
-- -------------------------------------------------------------


-- CREATE TABLE "users" ----------------------------------------
CREATE TABLE `users`( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`name` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	`email` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	`password` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	`phone_number` VarChar( 10 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	`role_id` Int( 1 ) NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 9;
-- -------------------------------------------------------------


-- CREATE TABLE "vehicle_types" --------------------------------
CREATE TABLE `vehicle_types`( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`name` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	`status` Int( 1 ) NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 4;
-- -------------------------------------------------------------


-- CREATE TABLE "vehicles" -------------------------------------
CREATE TABLE `vehicles`( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`type_id` Int( 11 ) NOT NULL,
	`seat` Int( 100 ) NOT NULL,
	`plate_number` VarChar( 100 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8mb4
COLLATE = utf8mb4_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 8;
-- -------------------------------------------------------------


-- Dump data of "news" -------------------------------------
INSERT INTO `news`(`id`,`image`,`title`,`content`) VALUES 
( '2', 'public/images/5e81e4cc1793c-ten-nhan-vat-game-audition-5.jpg', 'Lorem, ipsum dolor.', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic, dolorum?' ),
( '3', 'public/images/5e81dd25dcc7b-Best-PC-Games-GTAV.jpg', 'Lorem, ipsum dolor.', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic, dolorum?' ),
( '4', 'public/images/5e81e56903319-INSIDE-1.jpg', 'Lorem, ipsum dolor.', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic, dolorum?' ),
( '7', 'public/images/5e8300ba4d995-5e7d871aa732a-error_bg.jpg', 'Lorem, ipsum dolor.', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic, dolorum?' ),
( '10', 'public/images/5e8456a0e62d0-maxresdefault.jpg', 'Lorem, ipsum dolor.', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic, dolorum?' );
-- ---------------------------------------------------------


-- Dump data of "order_detail" -----------------------------
-- ---------------------------------------------------------


-- Dump data of "orders" -----------------------------------
-- ---------------------------------------------------------


-- Dump data of "roles" ------------------------------------
INSERT INTO `roles`(`id`,`name`,`status`) VALUES 
( '1', 'Người Dùng - User', '1' ),
( '2', 'Quản trị - Admin', '1' ),
( '3', 'Quản trị - Super Admin', '0' );
-- ---------------------------------------------------------


-- Dump data of "route_schedules" --------------------------
INSERT INTO `route_schedules`(`id`,`route_id`,`vehicle_id`,`price`,`start_time`,`end_time`) VALUES 
( '8', '1', '1', '120000', '03/07/2020 9:30 AM', '03/07/2020 12:30 PM' ),
( '9', '2', '1', '80000', '03/08/2020 9:46 AM', '03/10/2020 12:45 PM' );
-- ---------------------------------------------------------


-- Dump data of "routes" -----------------------------------
INSERT INTO `routes`(`id`,`distance`,`estimate_time`,`begin_point`,`end_point`) VALUES 
( '1', '160km', '04:00:00.000000', 'Mỹ Đình', 'Nam Định' ),
( '2', '180km', '04:20:00.000000', 'Hải Hậu', 'Giáp Bát' );
-- ---------------------------------------------------------


-- Dump data of "users" ------------------------------------
INSERT INTO `users`(`id`,`name`,`email`,`password`,`phone_number`,`role_id`) VALUES 
( '2', 'ThienTH', 'thienth@gmail.com', '$2y$10$4ijdV/Z4EA7fLZRnYGmhMeLo9.a7wgyBpCap1V5SjPKSTenSDTSFa', '123456789', '3' ),
( '3', 'Hồng Quân', 'helgrindxxx@gmail.com', '$2y$10$/9RCcuWqFwwH1eRgLbg3ue5a/7n2NPHOc0oPc9QYMoxOn6meQSWge', '0914946200', '2' ),
( '7', 'Sơn', 'ok@gmail.com', '$2y$10$xMi273mUNTQi1wsiyoAWkuUnSdKqgPFjC0Jl1JK.4SKtlROQJ8x4i', '', '1' ),
( '8', 'Sơn', 'son@gmail.com', '$2y$10$I5VitogA/1kBqDfnrhBsSO/92xwuvHqm.MXDbwk7sQ.ZvgQR7BGuC', '1231232132', '3' );
-- ---------------------------------------------------------


-- Dump data of "vehicle_types" ----------------------------
INSERT INTO `vehicle_types`(`id`,`name`,`status`) VALUES 
( '1', 'Xe Bus 2 tầng', '0' ),
( '2', 'Xe Limousine', '0' ),
( '3', 'Xe cút kít', '1' );
-- ---------------------------------------------------------


-- Dump data of "vehicles" ---------------------------------
INSERT INTO `vehicles`(`id`,`type_id`,`seat`,`plate_number`) VALUES 
( '1', '1', '30', '29T9-999.99' ),
( '6', '1', '16', '18H1-888.88' ),
( '7', '2', '16', '29G9-666.66' );
-- ---------------------------------------------------------


-- CREATE INDEX "order_id" -------------------------------------
CREATE INDEX `order_id` USING BTREE ON `order_detail`( `order_id` );
-- -------------------------------------------------------------


-- CREATE INDEX "schedule_id" ----------------------------------
CREATE INDEX `schedule_id` USING BTREE ON `order_detail`( `schedule_id` );
-- -------------------------------------------------------------


-- CREATE INDEX "user_id" --------------------------------------
CREATE INDEX `user_id` USING BTREE ON `orders`( `user_id` );
-- -------------------------------------------------------------


-- CREATE INDEX "route_id" -------------------------------------
CREATE INDEX `route_id` USING BTREE ON `route_schedules`( `route_id` );
-- -------------------------------------------------------------


-- CREATE INDEX "vehicle_id" -----------------------------------
CREATE INDEX `vehicle_id` USING BTREE ON `route_schedules`( `vehicle_id` );
-- -------------------------------------------------------------


-- CREATE INDEX "role_id" --------------------------------------
CREATE INDEX `role_id` USING BTREE ON `users`( `role_id` );
-- -------------------------------------------------------------


-- CREATE INDEX "type_id" --------------------------------------
CREATE INDEX `type_id` USING BTREE ON `vehicles`( `type_id` );
-- -------------------------------------------------------------


-- CREATE LINK "order_detail_ibfk_1" ---------------------------
ALTER TABLE `order_detail`
	ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY ( `order_id` )
	REFERENCES `orders`( `id` )
	ON DELETE Restrict
	ON UPDATE Restrict;
-- -------------------------------------------------------------


-- CREATE LINK "order_detail_ibfk_2" ---------------------------
ALTER TABLE `order_detail`
	ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY ( `schedule_id` )
	REFERENCES `route_schedules`( `id` )
	ON DELETE Restrict
	ON UPDATE Restrict;
-- -------------------------------------------------------------


-- CREATE LINK "orders_ibfk_1" ---------------------------------
ALTER TABLE `orders`
	ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY ( `user_id` )
	REFERENCES `users`( `id` )
	ON DELETE Restrict
	ON UPDATE Restrict;
-- -------------------------------------------------------------


-- CREATE LINK "route_schedules_ibfk_1" ------------------------
ALTER TABLE `route_schedules`
	ADD CONSTRAINT `route_schedules_ibfk_1` FOREIGN KEY ( `route_id` )
	REFERENCES `routes`( `id` )
	ON DELETE Restrict
	ON UPDATE Restrict;
-- -------------------------------------------------------------


-- CREATE LINK "route_schedules_ibfk_2" ------------------------
ALTER TABLE `route_schedules`
	ADD CONSTRAINT `route_schedules_ibfk_2` FOREIGN KEY ( `vehicle_id` )
	REFERENCES `vehicles`( `id` )
	ON DELETE Restrict
	ON UPDATE Restrict;
-- -------------------------------------------------------------


-- CREATE LINK "users_ibfk_1" ----------------------------------
ALTER TABLE `users`
	ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY ( `role_id` )
	REFERENCES `roles`( `id` )
	ON DELETE Restrict
	ON UPDATE Restrict;
-- -------------------------------------------------------------


-- CREATE LINK "vehicles_ibfk_1" -------------------------------
ALTER TABLE `vehicles`
	ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY ( `type_id` )
	REFERENCES `vehicle_types`( `id` )
	ON DELETE Restrict
	ON UPDATE Restrict;
-- -------------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


