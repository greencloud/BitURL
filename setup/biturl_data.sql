SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `biturl_data` (
  `id` int(9) NOT NULL,
  `url_id` varchar(8) NOT NULL,
  `url_actual` mediumtext NOT NULL,
  `url_short` varchar(64) NOT NULL,
  `url_hits` int(9) NOT NULL DEFAULT '0',
  `url_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `biturl_data`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `biturl_data`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;
COMMIT;
