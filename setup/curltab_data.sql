SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `curltab_data` (
  `id` int(9) NOT NULL,
  `url_id` varchar(8) NOT NULL,
  `url_title` varchar(64) NOT NULL,
  `url_long` mediumtext NOT NULL,
  `url_short` varchar(64) NOT NULL,
  `url_hits` int(9) NOT NULL DEFAULT '0',
  `url_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `curltab_data`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `curltab_data`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;
COMMIT;
