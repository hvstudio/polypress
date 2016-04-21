/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` (`id`, `name`, `value`) VALUES (1, 'defaultTarget', '1');
/*!40000 ALTER TABLE `options` ENABLE KEYS */;

/*!40000 ALTER TABLE `seoMeta` DISABLE KEYS */;
INSERT INTO `seoMeta` (`id`, `target_id`, `seo_title`, `seo_keywords`, `seo_description`, `seo_robots`, `sitemap_change_freq`, `sitemap_priority`) VALUES (1, 1, '', '', '', 'index', 'weekly', '0.5');
/*!40000 ALTER TABLE `seoMeta` ENABLE KEYS */;

/*!40000 ALTER TABLE `seoTarget` DISABLE KEYS */;
INSERT INTO `seoTarget` (`id`, `meta_id`, `target_presenter`, `target_action`, `target_id`) VALUES (1, 1, 'Front:Category', 'default', 1);
/*!40000 ALTER TABLE `seoTarget` ENABLE KEYS */;