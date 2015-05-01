-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2015 at 11:56 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wp3_`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_commentmeta`
--

CREATE TABLE IF NOT EXISTS `wp_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_comments`
--

CREATE TABLE IF NOT EXISTS `wp_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wp_comments`
--

INSERT INTO `wp_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'Mr WordPress', '', 'https://wordpress.org/', '', '2015-04-16 12:38:17', '2015-04-16 12:38:17', 'Hi, this is a comment.\nTo delete a comment, just log in and view the post&#039;s comments. There you will have the option to edit or delete them.', 0, '1', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_links`
--

CREATE TABLE IF NOT EXISTS `wp_links` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_options`
--

CREATE TABLE IF NOT EXISTS `wp_options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=426 ;

--
-- Dumping data for table `wp_options`
--

INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://localhost/wp3', 'yes'),
(2, 'home', 'http://localhost/wp3', 'yes'),
(3, 'blogname', 'WP3_', 'yes'),
(4, 'blogdescription', 'Just another WordPress site', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'ee@eee.rrhth', 'yes'),
(7, 'start_of_week', '1', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '1', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '1', 'yes'),
(12, 'posts_per_rss', '10', 'yes'),
(13, 'rss_use_excerpt', '0', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'open', 'yes'),
(20, 'default_ping_status', 'open', 'yes'),
(21, 'default_pingback_flag', '0', 'yes'),
(22, 'posts_per_page', '10', 'yes'),
(23, 'date_format', 'F j, Y', 'yes'),
(24, 'time_format', 'g:i a', 'yes'),
(25, 'links_updated_date_format', 'F j, Y g:i a', 'yes'),
(26, 'comment_moderation', '0', 'yes'),
(27, 'moderation_notify', '1', 'yes'),
(28, 'permalink_structure', '/%postname%', 'yes'),
(29, 'gzipcompression', '0', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'no'),
(33, 'active_plugins', 'a:2:{i:0;s:44:"multi-language-site-basiss/MultiLangSite.php";i:1;s:37:"quick-login-link/quick-login-link.php";}', 'yes'),
(34, 'category_base', '/fere', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'advanced_edit', '0', 'yes'),
(37, 'comment_max_links', '2', 'yes'),
(38, 'gmt_offset', '0', 'yes'),
(39, 'default_email_category', '1', 'yes'),
(40, 'recently_edited', '', 'no'),
(41, 'template', 'monochrome-pro', 'yes'),
(42, 'stylesheet', 'monochrome-pro', 'yes'),
(43, 'comment_whitelist', '1', 'yes'),
(44, 'blacklist_keys', '', 'no'),
(45, 'comment_registration', '0', 'yes'),
(46, 'html_type', 'text/html', 'yes'),
(47, 'use_trackback', '0', 'yes'),
(48, 'default_role', 'subscriber', 'yes'),
(49, 'db_version', '30133', 'yes'),
(50, 'uploads_use_yearmonth_folders', '1', 'yes'),
(51, 'upload_path', '', 'yes'),
(52, 'blog_public', '0', 'yes'),
(53, 'default_link_category', '2', 'yes'),
(54, 'show_on_front', 'posts', 'yes'),
(55, 'tag_base', '', 'yes'),
(56, 'show_avatars', '1', 'yes'),
(57, 'avatar_rating', 'G', 'yes'),
(58, 'upload_url_path', '', 'yes'),
(59, 'thumbnail_size_w', '150', 'yes'),
(60, 'thumbnail_size_h', '150', 'yes'),
(61, 'thumbnail_crop', '1', 'yes'),
(62, 'medium_size_w', '300', 'yes'),
(63, 'medium_size_h', '300', 'yes'),
(64, 'avatar_default', 'mystery', 'yes'),
(65, 'large_size_w', '1024', 'yes'),
(66, 'large_size_h', '1024', 'yes'),
(67, 'image_default_link_type', 'file', 'yes'),
(68, 'image_default_size', '', 'yes'),
(69, 'image_default_align', '', 'yes'),
(70, 'close_comments_for_old_posts', '0', 'yes'),
(71, 'close_comments_days_old', '14', 'yes'),
(72, 'thread_comments', '1', 'yes'),
(73, 'thread_comments_depth', '5', 'yes'),
(74, 'page_comments', '0', 'yes'),
(75, 'comments_per_page', '50', 'yes'),
(76, 'default_comments_page', 'newest', 'yes'),
(77, 'comment_order', 'asc', 'yes'),
(78, 'sticky_posts', 'a:0:{}', 'yes'),
(79, 'widget_categories', 'a:2:{i:2;a:4:{s:5:"title";s:0:"";s:5:"count";i:0;s:12:"hierarchical";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(80, 'widget_text', 'a:0:{}', 'yes'),
(81, 'widget_rss', 'a:0:{}', 'yes'),
(82, 'uninstall_plugins', 'a:0:{}', 'no'),
(83, 'timezone_string', '', 'yes'),
(84, 'page_for_posts', '0', 'yes'),
(85, 'page_on_front', '0', 'yes'),
(86, 'default_post_format', '0', 'yes'),
(87, 'link_manager_enabled', '0', 'yes'),
(88, 'initial_db_version', '30133', 'yes'),
(89, 'wp_user_roles', 'a:5:{s:13:"administrator";a:2:{s:4:"name";s:13:"Administrator";s:12:"capabilities";a:62:{s:13:"switch_themes";b:1;s:11:"edit_themes";b:1;s:16:"activate_plugins";b:1;s:12:"edit_plugins";b:1;s:10:"edit_users";b:1;s:10:"edit_files";b:1;s:14:"manage_options";b:1;s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:6:"import";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:8:"level_10";b:1;s:7:"level_9";b:1;s:7:"level_8";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;s:12:"delete_users";b:1;s:12:"create_users";b:1;s:17:"unfiltered_upload";b:1;s:14:"edit_dashboard";b:1;s:14:"update_plugins";b:1;s:14:"delete_plugins";b:1;s:15:"install_plugins";b:1;s:13:"update_themes";b:1;s:14:"install_themes";b:1;s:11:"update_core";b:1;s:10:"list_users";b:1;s:12:"remove_users";b:1;s:9:"add_users";b:1;s:13:"promote_users";b:1;s:18:"edit_theme_options";b:1;s:13:"delete_themes";b:1;s:6:"export";b:1;}}s:6:"editor";a:2:{s:4:"name";s:6:"Editor";s:12:"capabilities";a:34:{s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;}}s:6:"author";a:2:{s:4:"name";s:6:"Author";s:12:"capabilities";a:10:{s:12:"upload_files";b:1;s:10:"edit_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:4:"read";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;s:22:"delete_published_posts";b:1;}}s:11:"contributor";a:2:{s:4:"name";s:11:"Contributor";s:12:"capabilities";a:5:{s:10:"edit_posts";b:1;s:4:"read";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;}}s:10:"subscriber";a:2:{s:4:"name";s:10:"Subscriber";s:12:"capabilities";a:2:{s:4:"read";b:1;s:7:"level_0";b:1;}}}', 'yes'),
(90, 'widget_search', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(91, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(92, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(93, 'widget_archives', 'a:2:{i:2;a:3:{s:5:"title";s:0:"";s:5:"count";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(94, 'widget_meta', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(95, 'sidebars_widgets', 'a:9:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}s:9:"sidebar-2";N;s:9:"sidebar-3";N;s:9:"sidebar-4";N;s:9:"sidebar-5";N;s:9:"sidebar-6";N;s:13:"widget1__MLSS";N;s:13:"array_version";i:3;}', 'yes'),
(96, 'cron', 'a:5:{i:1429533507;a:3:{s:16:"wp_version_check";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:17:"wp_update_plugins";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:16:"wp_update_themes";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1429533520;a:1:{s:19:"wp_scheduled_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1429533662;a:1:{s:30:"wp_scheduled_auto_draft_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}i:1429558380;a:1:{s:20:"wp_maybe_auto_update";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}s:7:"version";i:2;}', 'yes'),
(98, '_site_transient_update_core', 'O:8:"stdClass":4:{s:7:"updates";a:1:{i:0;O:8:"stdClass":10:{s:8:"response";s:6:"latest";s:8:"download";s:59:"https://downloads.wordpress.org/release/wordpress-4.1.1.zip";s:6:"locale";s:5:"en_US";s:8:"packages";O:8:"stdClass":5:{s:4:"full";s:59:"https://downloads.wordpress.org/release/wordpress-4.1.1.zip";s:10:"no_content";s:70:"https://downloads.wordpress.org/release/wordpress-4.1.1-no-content.zip";s:11:"new_bundled";s:71:"https://downloads.wordpress.org/release/wordpress-4.1.1-new-bundled.zip";s:7:"partial";b:0;s:8:"rollback";b:0;}s:7:"current";s:5:"4.1.1";s:7:"version";s:5:"4.1.1";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"4.1";s:15:"partial_version";s:0:"";}}s:12:"last_checked";i:1429515190;s:15:"version_checked";s:5:"4.1.1";s:12:"translations";a:0:{}}', 'yes'),
(103, '_site_transient_update_themes', 'O:8:"stdClass":4:{s:12:"last_checked";i:1429515191;s:7:"checked";a:6:{s:14:"fastnews-1.0.6";s:5:"1.0.6";s:15:"manager-emplyee";s:3:"1.1";s:14:"monochrome-pro";s:3:"2.3";s:15:"new-lotus-1.0.0";s:5:"1.0.0";s:13:"twentyfifteen";s:3:"1.0";s:8:"whitexma";s:4:"1.01";}s:8:"response";a:0:{}s:12:"translations";a:0:{}}', 'yes'),
(105, '_transient_random_seed', '44703f946711ddb736455264be01d5e4', 'yes'),
(106, '_site_transient_timeout_browser_48ce97d67f5c394f5ce1d5ccaf049307', '1429792721', 'yes'),
(107, '_site_transient_browser_48ce97d67f5c394f5ce1d5ccaf049307', 'a:9:{s:8:"platform";s:7:"Windows";s:4:"name";s:7:"Firefox";s:7:"version";s:4:"37.0";s:10:"update_url";s:23:"http://www.firefox.com/";s:7:"img_src";s:50:"http://s.wordpress.org/images/browsers/firefox.png";s:11:"img_src_ssl";s:49:"https://wordpress.org/images/browsers/firefox.png";s:15:"current_version";s:2:"16";s:7:"upgrade";b:0;s:8:"insecure";b:0;}', 'yes'),
(110, 'can_compress_scripts', '1', 'yes'),
(127, 'recently_activated', 'a:1:{s:44:"multi-language-site-basiss/MultiLangSite.php";i:1429511696;}', 'yes'),
(129, 'optMLSS__Lngs', 'English{eng},Русский{rus},Japan{jpn}', 'yes'),
(130, 'optMLSS__HiddenLangs', 'Japan{jpn},Dutch{nld},', 'yes'),
(131, 'optMLSS__DefForOthers', 'dropdownn', 'yes'),
(132, 'optMLSS__FirstMethod', 'dropddd', 'yes'),
(133, 'optMLSS__BuildType', 'custom_p', 'yes'),
(134, 'optMLSS__Target_rus', 'Russian Federation,Belarus,Ukraine,Kyrgyzstan,', 'yes'),
(135, 'optMLSS__Target_default', 'eng', 'yes'),
(136, 'optMLSS__DropdHeader', 'y', 'yes'),
(137, 'optMLSS__DropdSidePos', 'left', 'yes'),
(138, 'optMLSS__DropdDistanceTop', '70', 'yes'),
(139, 'optMLSS__DropdDistanceSide', '50', 'yes'),
(140, 'optMLSS__CategSlugname', '', 'yes'),
(141, 'optMLSS__PageSlugname', '', 'yes'),
(146, 'theme_mods_twentyfifteen', 'a:1:{s:16:"sidebars_widgets";a:2:{s:4:"time";i:1429187986;s:4:"data";a:2:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar-1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}}}}', 'yes'),
(147, 'current_theme', 'Monochrome Pro', 'yes'),
(148, 'theme_mods_fastnews-1.0.6', 'a:2:{i:0;b:0;s:16:"sidebars_widgets";a:2:{s:4:"time";i:1429290422;s:4:"data";a:19:{s:19:"wp_inactive_widgets";a:0:{}s:9:"sidebar_1";a:6:{i:0;s:8:"search-2";i:1;s:14:"recent-posts-2";i:2;s:17:"recent-comments-2";i:3;s:10:"archives-2";i:4;s:12:"categories-2";i:5;s:6:"meta-2";}s:9:"sidebar_2";N;s:9:"sidebar_3";N;s:9:"sidebar_4";N;s:9:"sidebar_5";N;s:9:"sidebar_6";N;s:9:"sidebar_7";N;s:9:"sidebar_8";N;s:9:"sidebar_9";N;s:10:"sidebar_10";N;s:10:"sidebar_11";N;s:10:"sidebar_12";N;s:10:"sidebar_13";N;s:10:"sidebar_14";N;s:10:"sidebar_15";N;s:10:"sidebar_16";N;s:10:"sidebar_17";N;s:13:"widget1__MLSS";N;}}}', 'yes'),
(149, 'theme_switched', '', 'yes'),
(154, 'optMLSS__Cat_base_BACKUP', '', 'yes'),
(160, 'optMLSS__FixedLang', '', 'yes'),
(161, 'optMLSS__Target_eng', '', 'yes'),
(163, 'optMLSS__EnableCustCat', 'n', 'yes'),
(164, 'optMLSS__HomeID_eng', '', 'yes'),
(165, 'optMLSS__HomeID_rus', '', 'yes'),
(183, 'category_children', 'a:2:{i:2;a:1:{i:0;i:3;}i:4;a:1:{i:0;i:5;}}', 'yes'),
(214, 'eng_children', 'a:1:{i:7;a:1:{i:0;i:8;}}', 'yes'),
(236, 'theme_mods_monochrome-pro', 'a:1:{i:0;b:0;}', 'yes'),
(254, 'optMLSS__Target_', '', 'yes'),
(255, 'optMLSS__HomeID_', '', 'yes'),
(257, 'optMLSS__ShowHideOtherCats', 'yes', 'yes'),
(260, 'optMLSS__Target_jpn', '', 'yes'),
(261, 'optMLSS__HomeID_jpn', '', 'yes'),
(263, 'optMLSS__Target_jpsn', '', 'yes'),
(264, 'optMLSS__HomeID_jpsn', '', 'yes'),
(270, '_transient_timeout_feed_ac0b00fe65abe10e0c5b588f3ed8c7ca', '1429553856', 'no'),
(272, '_transient_timeout_feed_mod_ac0b00fe65abe10e0c5b588f3ed8c7ca', '1429553856', 'no'),
(273, '_transient_feed_mod_ac0b00fe65abe10e0c5b588f3ed8c7ca', '1429510656', 'no'),
(274, '_transient_timeout_feed_d117b5738fbd35bd8c0391cda1f2b5d9', '1429553859', 'no');
INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(276, '_transient_timeout_feed_mod_d117b5738fbd35bd8c0391cda1f2b5d9', '1429553859', 'no'),
(277, '_transient_feed_mod_d117b5738fbd35bd8c0391cda1f2b5d9', '1429510659', 'no'),
(278, '_transient_timeout_feed_b9388c83948825c1edaef0d856b7b109', '1429553860', 'no'),
(280, '_transient_timeout_feed_mod_b9388c83948825c1edaef0d856b7b109', '1429553860', 'no'),
(281, '_transient_feed_mod_b9388c83948825c1edaef0d856b7b109', '1429510660', 'no'),
(282, '_transient_timeout_plugin_slugs', '1429598097', 'no'),
(283, '_transient_plugin_slugs', 'a:14:{i:0;s:57:"another-simple-xml-sitemap/another-simple-xml-sitemap.php";i:1;s:43:"clean-surplus-junk-data/prevent_surplus.php";i:2;s:60:"clickbank-download-protector/___dont_touch_this_file____.php";i:3;s:71:"disable-user-modify-profile-page/disable-user-profile-modify-access.php";i:4;s:38:"file-manager-database-backup/index.php";i:5;s:35:"kopa_shortcodes/kopa_shortcodes.php";i:6;s:41:"login-tracker-logs/login-tracker-logs.php";i:7;s:37:"meta-tags-fields/Meta-Tags-Fields.php";i:8;s:44:"multi-language-site-basiss/MultiLangSite.php";i:9;s:37:"quick-login-link/quick-login-link.php";i:10;s:66:"remove-dashboard-access-for-non-admins/remove-dashboard-access.php";i:11;s:51:"system-edit-restriction/system-edit-restriction.php";i:12;s:41:"theme-test-preview/theme-test-preview.php";i:13;s:41:"wordpress-importer/wordpress-importer.php";}', 'no'),
(284, '_transient_timeout_dash_4077549d03da2e451c8b5f002294ff51', '1429553861', 'no'),
(344, '_site_transient_timeout_theme_roots', '1429516988', 'yes'),
(345, '_site_transient_theme_roots', 'a:6:{s:14:"fastnews-1.0.6";s:7:"/themes";s:15:"manager-emplyee";s:7:"/themes";s:14:"monochrome-pro";s:7:"/themes";s:15:"new-lotus-1.0.0";s:7:"/themes";s:13:"twentyfifteen";s:7:"/themes";s:8:"whitexma";s:7:"/themes";}', 'yes');
INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(346, '_site_transient_update_plugins', 'O:8:"stdClass":4:{s:12:"last_checked";i:1429515191;s:8:"response";a:1:{s:66:"remove-dashboard-access-for-non-admins/remove-dashboard-access.php";O:8:"stdClass":6:{s:2:"id";s:5:"25732";s:4:"slug";s:38:"remove-dashboard-access-for-non-admins";s:6:"plugin";s:66:"remove-dashboard-access-for-non-admins/remove-dashboard-access.php";s:11:"new_version";s:5:"1.1.3";s:3:"url";s:69:"https://wordpress.org/plugins/remove-dashboard-access-for-non-admins/";s:7:"package";s:87:"https://downloads.wordpress.org/plugin/remove-dashboard-access-for-non-admins.1.1.3.zip";}}s:12:"translations";a:0:{}s:9:"no_update";a:11:{s:57:"another-simple-xml-sitemap/another-simple-xml-sitemap.php";O:8:"stdClass":6:{s:2:"id";s:5:"42482";s:4:"slug";s:26:"another-simple-xml-sitemap";s:6:"plugin";s:57:"another-simple-xml-sitemap/another-simple-xml-sitemap.php";s:11:"new_version";s:3:"1.2";s:3:"url";s:57:"https://wordpress.org/plugins/another-simple-xml-sitemap/";s:7:"package";s:69:"https://downloads.wordpress.org/plugin/another-simple-xml-sitemap.zip";}s:43:"clean-surplus-junk-data/prevent_surplus.php";O:8:"stdClass":6:{s:2:"id";s:5:"47888";s:4:"slug";s:23:"clean-surplus-junk-data";s:6:"plugin";s:43:"clean-surplus-junk-data/prevent_surplus.php";s:11:"new_version";s:5:"1.0.1";s:3:"url";s:54:"https://wordpress.org/plugins/clean-surplus-junk-data/";s:7:"package";s:66:"https://downloads.wordpress.org/plugin/clean-surplus-junk-data.zip";}s:71:"disable-user-modify-profile-page/disable-user-profile-modify-access.php";O:8:"stdClass":6:{s:2:"id";s:5:"59007";s:4:"slug";s:32:"disable-user-modify-profile-page";s:6:"plugin";s:71:"disable-user-modify-profile-page/disable-user-profile-modify-access.php";s:11:"new_version";s:3:"1.1";s:3:"url";s:63:"https://wordpress.org/plugins/disable-user-modify-profile-page/";s:7:"package";s:75:"https://downloads.wordpress.org/plugin/disable-user-modify-profile-page.zip";}s:38:"file-manager-database-backup/index.php";O:8:"stdClass":6:{s:2:"id";s:5:"54948";s:4:"slug";s:28:"file-manager-database-backup";s:6:"plugin";s:38:"file-manager-database-backup/index.php";s:11:"new_version";s:3:"1.1";s:3:"url";s:59:"https://wordpress.org/plugins/file-manager-database-backup/";s:7:"package";s:71:"https://downloads.wordpress.org/plugin/file-manager-database-backup.zip";}s:41:"login-tracker-logs/login-tracker-logs.php";O:8:"stdClass":6:{s:2:"id";s:5:"53820";s:4:"slug";s:18:"login-tracker-logs";s:6:"plugin";s:41:"login-tracker-logs/login-tracker-logs.php";s:11:"new_version";s:3:"1.2";s:3:"url";s:49:"https://wordpress.org/plugins/login-tracker-logs/";s:7:"package";s:61:"https://downloads.wordpress.org/plugin/login-tracker-logs.zip";}s:37:"meta-tags-fields/Meta-Tags-Fields.php";O:8:"stdClass":6:{s:2:"id";s:5:"41369";s:4:"slug";s:16:"meta-tags-fields";s:6:"plugin";s:37:"meta-tags-fields/Meta-Tags-Fields.php";s:11:"new_version";s:3:"1.4";s:3:"url";s:47:"https://wordpress.org/plugins/meta-tags-fields/";s:7:"package";s:59:"https://downloads.wordpress.org/plugin/meta-tags-fields.zip";}s:44:"multi-language-site-basiss/MultiLangSite.php";O:8:"stdClass":6:{s:2:"id";s:5:"58733";s:4:"slug";s:25:"multi-language-site-basis";s:6:"plugin";s:44:"multi-language-site-basiss/MultiLangSite.php";s:11:"new_version";s:4:"1.25";s:3:"url";s:56:"https://wordpress.org/plugins/multi-language-site-basis/";s:7:"package";s:68:"https://downloads.wordpress.org/plugin/multi-language-site-basis.zip";}s:37:"quick-login-link/quick-login-link.php";O:8:"stdClass":6:{s:2:"id";s:5:"53871";s:4:"slug";s:16:"quick-login-link";s:6:"plugin";s:37:"quick-login-link/quick-login-link.php";s:11:"new_version";s:3:"1.1";s:3:"url";s:47:"https://wordpress.org/plugins/quick-login-link/";s:7:"package";s:59:"https://downloads.wordpress.org/plugin/quick-login-link.zip";}s:51:"system-edit-restriction/system-edit-restriction.php";O:8:"stdClass":6:{s:2:"id";s:5:"54298";s:4:"slug";s:23:"system-edit-restriction";s:6:"plugin";s:51:"system-edit-restriction/system-edit-restriction.php";s:11:"new_version";s:3:"1.1";s:3:"url";s:54:"https://wordpress.org/plugins/system-edit-restriction/";s:7:"package";s:66:"https://downloads.wordpress.org/plugin/system-edit-restriction.zip";}s:41:"theme-test-preview/theme-test-preview.php";O:8:"stdClass":6:{s:2:"id";s:5:"53693";s:4:"slug";s:18:"theme-test-preview";s:6:"plugin";s:41:"theme-test-preview/theme-test-preview.php";s:11:"new_version";s:3:"1.2";s:3:"url";s:49:"https://wordpress.org/plugins/theme-test-preview/";s:7:"package";s:61:"https://downloads.wordpress.org/plugin/theme-test-preview.zip";}s:41:"wordpress-importer/wordpress-importer.php";O:8:"stdClass":6:{s:2:"id";s:5:"14975";s:4:"slug";s:18:"wordpress-importer";s:6:"plugin";s:41:"wordpress-importer/wordpress-importer.php";s:11:"new_version";s:5:"0.6.1";s:3:"url";s:49:"https://wordpress.org/plugins/wordpress-importer/";s:7:"package";s:67:"https://downloads.wordpress.org/plugin/wordpress-importer.0.6.1.zip";}}}', 'yes'),
(425, 'rewrite_rules', 'a:109:{s:6:"eng/?$";s:23:"index.php?post_type=eng";s:36:"eng/feed/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?post_type=eng&feed=$matches[1]";s:31:"eng/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?post_type=eng&feed=$matches[1]";s:23:"eng/page/([0-9]{1,})/?$";s:41:"index.php?post_type=eng&paged=$matches[1]";s:6:"rus/?$";s:23:"index.php?post_type=rus";s:36:"rus/feed/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?post_type=rus&feed=$matches[1]";s:31:"rus/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?post_type=rus&feed=$matches[1]";s:23:"rus/page/([0-9]{1,})/?$";s:41:"index.php?post_type=rus&paged=$matches[1]";s:6:"jpn/?$";s:23:"index.php?post_type=jpn";s:36:"jpn/feed/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?post_type=jpn&feed=$matches[1]";s:31:"jpn/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?post_type=jpn&feed=$matches[1]";s:23:"jpn/page/([0-9]{1,})/?$";s:41:"index.php?post_type=jpn&paged=$matches[1]";s:43:"fere/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:38:"fere/(.+?)/(feed|rdf|rss|rss2|atom)/?$";s:52:"index.php?category_name=$matches[1]&feed=$matches[2]";s:31:"fere/(.+?)/page/?([0-9]{1,})/?$";s:53:"index.php?category_name=$matches[1]&paged=$matches[2]";s:13:"fere/(.+?)/?$";s:35:"index.php?category_name=$matches[1]";s:44:"tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:39:"tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?tag=$matches[1]&feed=$matches[2]";s:32:"tag/([^/]+)/page/?([0-9]{1,})/?$";s:43:"index.php?tag=$matches[1]&paged=$matches[2]";s:14:"tag/([^/]+)/?$";s:25:"index.php?tag=$matches[1]";s:45:"type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:40:"type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?post_format=$matches[1]&feed=$matches[2]";s:33:"type/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?post_format=$matches[1]&paged=$matches[2]";s:15:"type/([^/]+)/?$";s:33:"index.php?post_format=$matches[1]";s:31:"eng/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:41:"eng/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:61:"eng/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:56:"eng/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:56:"eng/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:24:"eng/([^/]+)/trackback/?$";s:30:"index.php?eng=$matches[1]&tb=1";s:44:"eng/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?eng=$matches[1]&feed=$matches[2]";s:39:"eng/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?eng=$matches[1]&feed=$matches[2]";s:32:"eng/([^/]+)/page/?([0-9]{1,})/?$";s:43:"index.php?eng=$matches[1]&paged=$matches[2]";s:24:"eng/([^/]+)(/[0-9]+)?/?$";s:42:"index.php?eng=$matches[1]&page=$matches[2]";s:31:"rus/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:41:"rus/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:61:"rus/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:56:"rus/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:56:"rus/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:24:"rus/([^/]+)/trackback/?$";s:30:"index.php?rus=$matches[1]&tb=1";s:44:"rus/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?rus=$matches[1]&feed=$matches[2]";s:39:"rus/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?rus=$matches[1]&feed=$matches[2]";s:32:"rus/([^/]+)/page/?([0-9]{1,})/?$";s:43:"index.php?rus=$matches[1]&paged=$matches[2]";s:24:"rus/([^/]+)(/[0-9]+)?/?$";s:42:"index.php?rus=$matches[1]&page=$matches[2]";s:31:"jpn/[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:41:"jpn/[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:61:"jpn/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:56:"jpn/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:56:"jpn/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:24:"jpn/([^/]+)/trackback/?$";s:30:"index.php?jpn=$matches[1]&tb=1";s:44:"jpn/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?jpn=$matches[1]&feed=$matches[2]";s:39:"jpn/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?jpn=$matches[1]&feed=$matches[2]";s:32:"jpn/([^/]+)/page/?([0-9]{1,})/?$";s:43:"index.php?jpn=$matches[1]&paged=$matches[2]";s:24:"jpn/([^/]+)(/[0-9]+)?/?$";s:42:"index.php?jpn=$matches[1]&page=$matches[2]";s:48:".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$";s:18:"index.php?feed=old";s:20:".*wp-app\\.php(/.*)?$";s:19:"index.php?error=403";s:18:".*wp-register.php$";s:23:"index.php?register=true";s:32:"feed/(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:27:"(feed|rdf|rss|rss2|atom)/?$";s:27:"index.php?&feed=$matches[1]";s:20:"page/?([0-9]{1,})/?$";s:28:"index.php?&paged=$matches[1]";s:41:"comments/feed/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:36:"comments/(feed|rdf|rss|rss2|atom)/?$";s:42:"index.php?&feed=$matches[1]&withcomments=1";s:44:"search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:39:"search/(.+)/(feed|rdf|rss|rss2|atom)/?$";s:40:"index.php?s=$matches[1]&feed=$matches[2]";s:32:"search/(.+)/page/?([0-9]{1,})/?$";s:41:"index.php?s=$matches[1]&paged=$matches[2]";s:14:"search/(.+)/?$";s:23:"index.php?s=$matches[1]";s:47:"author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:42:"author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:50:"index.php?author_name=$matches[1]&feed=$matches[2]";s:35:"author/([^/]+)/page/?([0-9]{1,})/?$";s:51:"index.php?author_name=$matches[1]&paged=$matches[2]";s:17:"author/([^/]+)/?$";s:33:"index.php?author_name=$matches[1]";s:69:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:64:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:80:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]";s:57:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:81:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]";s:39:"([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$";s:63:"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]";s:56:"([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:51:"([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$";s:64:"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]";s:44:"([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$";s:65:"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]";s:26:"([0-9]{4})/([0-9]{1,2})/?$";s:47:"index.php?year=$matches[1]&monthnum=$matches[2]";s:43:"([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:38:"([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?year=$matches[1]&feed=$matches[2]";s:31:"([0-9]{4})/page/?([0-9]{1,})/?$";s:44:"index.php?year=$matches[1]&paged=$matches[2]";s:13:"([0-9]{4})/?$";s:26:"index.php?year=$matches[1]";s:27:".?.+?/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:37:".?.+?/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:57:".?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:".?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:20:"(.?.+?)/trackback/?$";s:35:"index.php?pagename=$matches[1]&tb=1";s:40:"(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:35:"(.?.+?)/(feed|rdf|rss|rss2|atom)/?$";s:47:"index.php?pagename=$matches[1]&feed=$matches[2]";s:28:"(.?.+?)/page/?([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&paged=$matches[2]";s:35:"(.?.+?)/comment-page-([0-9]{1,})/?$";s:48:"index.php?pagename=$matches[1]&cpage=$matches[2]";s:20:"(.?.+?)(/[0-9]+)?/?$";s:47:"index.php?pagename=$matches[1]&page=$matches[2]";s:27:"[^/]+/attachment/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:37:"[^/]+/attachment/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:57:"[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:"[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:52:"[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";s:20:"([^/]+)/trackback/?$";s:31:"index.php?name=$matches[1]&tb=1";s:40:"([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?name=$matches[1]&feed=$matches[2]";s:35:"([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:43:"index.php?name=$matches[1]&feed=$matches[2]";s:28:"([^/]+)/page/?([0-9]{1,})/?$";s:44:"index.php?name=$matches[1]&paged=$matches[2]";s:35:"([^/]+)/comment-page-([0-9]{1,})/?$";s:44:"index.php?name=$matches[1]&cpage=$matches[2]";s:20:"([^/]+)(/[0-9]+)?/?$";s:43:"index.php?name=$matches[1]&page=$matches[2]";s:16:"[^/]+/([^/]+)/?$";s:32:"index.php?attachment=$matches[1]";s:26:"[^/]+/([^/]+)/trackback/?$";s:37:"index.php?attachment=$matches[1]&tb=1";s:46:"[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:41:"[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$";s:49:"index.php?attachment=$matches[1]&feed=$matches[2]";s:41:"[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$";s:50:"index.php?attachment=$matches[1]&cpage=$matches[2]";}', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `wp_postmeta`
--

CREATE TABLE IF NOT EXISTS `wp_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `wp_postmeta`
--

INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'default'),
(2, 4, '_edit_last', '1'),
(3, 4, '_edit_lock', '1429195400:1'),
(4, 5, '_edit_last', '1'),
(5, 5, '_edit_lock', '1429520748:1'),
(6, 12, '_edit_last', '1'),
(7, 12, '_edit_lock', '1429195680:1'),
(11, 15, '_edit_last', '1'),
(12, 15, '_edit_lock', '1429510821:1'),
(16, 18, '_edit_last', '1'),
(17, 18, '_edit_lock', '1429520592:1'),
(18, 22, '_edit_last', '1'),
(19, 22, '_edit_lock', '1429520435:1'),
(20, 24, '_edit_last', '1'),
(21, 24, '_edit_lock', '1429520617:1'),
(22, 22, 'kopa_fastnewslight_total_view', '11'),
(23, 24, 'kopa_fastnewslight_total_view', '1'),
(24, 5, 'kopa_fastnewslight_total_view', '9'),
(25, 15, 'kopa_fastnewslight_total_view', '24'),
(29, 33, '_edit_last', '1'),
(30, 33, '_edit_lock', '1429519777:1'),
(32, 99999999999999, '', ''),
(34, 1, '_edit_last', '1'),
(36, 1, '_edit_lock', '1429206844:1'),
(49, 39, '_edit_last', '1'),
(50, 39, '_edit_lock', '1429208152:1'),
(51, 39, 'kopa_fastnewslight_total_view', '4'),
(52, 50, '_edit_last', '1'),
(53, 50, '_edit_lock', '1429466158:1'),
(54, 66, '_edit_last', '1'),
(55, 66, '_edit_lock', '1429467721:1'),
(64, 22, '_wp_trash_meta_status', 'publish'),
(65, 22, '_wp_trash_meta_time', '1429520578'),
(70, 71, '_edit_last', '1'),
(71, 71, '_edit_lock', '1429521007:1');

-- --------------------------------------------------------

--
-- Table structure for table `wp_posts`
--

CREATE TABLE IF NOT EXISTS `wp_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(20) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `wp_posts`
--

INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2015-04-16 12:38:17', '2015-04-16 12:38:17', 'Welcome to WordPress. This is your first post. Edit or delete it, then start blogging!', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2015-04-16 17:54:03', '2015-04-16 17:54:03', '', 0, 'http://localhost/wp3/?p=1', 0, 'post', '', 1),
(2, 1, '2015-04-16 12:38:17', '2015-04-16 12:38:17', 'This is an example page. It''s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:\n\n<blockquote>Hi there! I''m a bike messenger by day, aspiring actor by night, and this is my blog. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin'' caught in the rain.)</blockquote>\n\n...or something like this:\n\n<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>\n\nAs a new WordPress user, you should go to <a href="http://localhost/wp3/wp-admin/">your dashboard</a> to delete this page and create new pages for your content. Have fun!', 'Sample Page', '', 'publish', 'open', 'open', '', 'sample-page', '', '', '2015-04-16 12:38:17', '2015-04-16 12:38:17', '', 0, 'http://localhost/wp3/?page_id=2', 0, 'page', '', 0),
(3, 1, '2015-04-16 12:38:42', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-16 12:38:42', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?p=3', 0, 'post', '', 0),
(4, 1, '2015-04-16 12:39:44', '2015-04-16 12:39:44', 'samplee', 'ROOTPAGE(eng)', '', 'publish', 'open', 'closed', '', 'eng', '', '', '2015-04-16 14:43:20', '2015-04-16 14:43:20', '', 0, 'http://localhost/wp3/?page_id=4', 0, 'page', '', 0),
(5, 1, '2015-04-16 12:39:44', '2015-04-16 12:39:44', 'samplee', 'SubPAGE(eng-sub) of ROOTPAGE', '', 'publish', 'open', 'closed', '', 'eng-sub', '', '', '2015-04-20 09:14:57', '2015-04-20 09:14:57', '', 4, 'http://localhost/wp3/?page_id=5', 0, 'page', '', 0),
(6, 1, '2015-04-16 12:39:44', '0000-00-00 00:00:00', 'samplee', 'rus', '', 'draft', 'open', 'open', '', 'rus', '', '', '2015-04-16 12:39:44', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?page_id=6', 0, 'page', '', 0),
(7, 1, '2015-04-16 12:39:44', '0000-00-00 00:00:00', 'samplee', 'my-sub-paag', '', 'draft', 'open', 'open', '', 'my-sub-paag', '', '', '2015-04-16 12:39:44', '0000-00-00 00:00:00', '', 6, 'http://localhost/wp3/?page_id=7', 0, 'page', '', 0),
(8, 1, '2015-04-16 12:40:02', '2015-04-16 12:40:02', 'samplee', 'eng', '', 'inherit', 'open', 'open', '', '4-revision-v1', '', '', '2015-04-16 12:40:02', '2015-04-16 12:40:02', '', 4, 'http://localhost/wp3/?p=8', 0, 'revision', '', 0),
(9, 1, '2015-04-16 12:40:11', '2015-04-16 12:40:11', 'samplee', 'eng-page', '', 'inherit', 'open', 'open', '', '4-revision-v1', '', '', '2015-04-16 12:40:11', '2015-04-16 12:40:11', '', 4, 'http://localhost/wp3/?p=9', 0, 'revision', '', 0),
(10, 1, '2015-04-16 12:40:35', '2015-04-16 12:40:35', 'samplee', 'eng-sub-page', '', 'inherit', 'open', 'open', '', '5-revision-v1', '', '', '2015-04-16 12:40:35', '2015-04-16 12:40:35', '', 5, 'http://localhost/wp3/?p=10', 0, 'revision', '', 0),
(11, 1, '2015-04-16 12:40:42', '2015-04-16 12:40:42', 'samplee', 'eng-root-page', '', 'inherit', 'open', 'open', '', '4-revision-v1', '', '', '2015-04-16 12:40:42', '2015-04-16 12:40:42', '', 4, 'http://localhost/wp3/?p=11', 0, 'revision', '', 0),
(12, 1, '2015-04-16 12:41:14', '2015-04-16 12:41:14', 'eng posttttt', 'ROOT_POST(eng) under ROOTCAT(eng)', '', 'publish', 'open', 'open', '', 'eng', '', '', '2015-04-16 14:48:00', '2015-04-16 14:48:00', '', 0, 'http://localhost/wp3/?p=12', 0, 'post', '', 0),
(13, 1, '2015-04-16 12:41:14', '2015-04-16 12:41:14', 'eng posttttt', 'eng', '', 'inherit', 'open', 'open', '', '12-revision-v1', '', '', '2015-04-16 12:41:14', '2015-04-16 12:41:14', '', 12, 'http://localhost/wp3/?p=13', 0, 'revision', '', 0),
(14, 1, '2015-04-16 12:46:29', '2015-04-16 12:46:29', 'eng posttttt', 'eng -post  ENG ROOT category', '', 'inherit', 'open', 'open', '', '12-revision-v1', '', '', '2015-04-16 12:46:29', '2015-04-16 12:46:29', '', 12, 'http://localhost/wp3/12-revision-v1', 0, 'revision', '', 0),
(15, 1, '2015-04-16 12:46:59', '2015-04-16 12:46:59', 'post in SUBCAT', 'ROOT_POST(eng-sub) under ROOTCAT(eng)', '', 'publish', 'open', 'open', '', 'eng-sub', '', '', '2015-04-20 06:20:21', '2015-04-20 06:20:21', '', 0, 'http://localhost/wp3/?p=15', 0, 'post', '', 0),
(16, 1, '2015-04-16 12:46:59', '2015-04-16 12:46:59', 'eng -post  ENG sub category', 'eng -post  ENG sub category', '', 'inherit', 'open', 'open', '', '15-revision-v1', '', '', '2015-04-16 12:46:59', '2015-04-16 12:46:59', '', 15, 'http://localhost/wp3/15-revision-v1', 0, 'revision', '', 0),
(17, 1, '2015-04-16 12:47:30', '2015-04-16 12:47:30', 'eng -post  ENG sub category', 'eng -post  ENG SUB category', '', 'inherit', 'open', 'open', '', '15-revision-v1', '', '', '2015-04-16 12:47:30', '2015-04-16 12:47:30', '', 15, 'http://localhost/wp3/15-revision-v1', 0, 'revision', '', 0),
(18, 1, '2015-04-16 12:49:32', '2015-04-16 12:49:32', 'eng cust post in ROOT', 'CUST_POST ROOT(eng) under ROOTCAT(eng)', '', 'publish', 'open', 'closed', '', 'eng', '', '', '2015-04-20 09:03:33', '2015-04-20 09:03:33', '', 0, 'http://localhost/wp3/?post_type=eng&#038;p=18', 0, 'eng', '', 0),
(19, 1, '2015-04-16 12:49:32', '2015-04-16 12:49:32', 'eng post type', 'eng', '', 'inherit', 'open', 'open', '', '18-revision-v1', '', '', '2015-04-16 12:49:32', '2015-04-16 12:49:32', '', 18, 'http://localhost/wp3/18-revision-v1', 0, 'revision', '', 0),
(20, 1, '2015-04-16 12:50:14', '2015-04-16 12:50:14', 'eng cust post in ROOT', 'eng cust post in ROOT', '', 'inherit', 'open', 'open', '', '18-revision-v1', '', '', '2015-04-16 12:50:14', '2015-04-16 12:50:14', '', 18, 'http://localhost/wp3/18-revision-v1', 0, 'revision', '', 0),
(21, 1, '2015-04-16 12:51:36', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-16 12:51:36', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=21', 0, 'eng', '', 0),
(22, 1, '2015-04-16 12:52:03', '2015-04-16 12:52:03', 'sub  CUSTpost in ROOTCAR', 'CUST_POST ROOT(eng-sub) under ROOTCAT(eng)', '', 'trash', 'open', 'closed', '', 'eng-sub', '', '', '2015-04-20 09:02:58', '2015-04-20 09:02:58', '', 0, 'http://localhost/wp3/?post_type=eng&#038;p=22', 0, 'eng', '', 0),
(23, 1, '2015-04-16 12:52:03', '2015-04-16 12:52:03', 'eng sub CUST in root', 'eng sub CUST in root', '', 'inherit', 'open', 'open', '', '22-revision-v1', '', '', '2015-04-16 12:52:03', '2015-04-16 12:52:03', '', 22, 'http://localhost/wp3/22-revision-v1', 0, 'revision', '', 0),
(24, 1, '2015-04-16 12:52:23', '2015-04-16 12:52:23', 'eng sub CUST in sub', 'CUST_POST sub-ROOT(eng-sub) under ROOTCAT(eng)', '', 'publish', 'open', 'closed', '', 'eng-sub', '', '', '2015-04-20 09:07:07', '2015-04-20 09:07:07', '', 18, 'http://localhost/wp3/?post_type=eng&#038;p=24', 0, 'eng', '', 0),
(25, 1, '2015-04-16 12:52:23', '2015-04-16 12:52:23', 'eng sub CUST in sub', 'eng sub CUST in sub', '', 'inherit', 'open', 'open', '', '24-revision-v1', '', '', '2015-04-16 12:52:23', '2015-04-16 12:52:23', '', 24, 'http://localhost/wp3/24-revision-v1', 0, 'revision', '', 0),
(26, 1, '2015-04-16 14:10:41', '2015-04-16 14:10:41', 'sub  CUSTpost in ROOTCAR', 'sub  CUSTpost in ROOTCAR', '', 'inherit', 'open', 'open', '', '22-revision-v1', '', '', '2015-04-16 14:10:41', '2015-04-16 14:10:41', '', 22, 'http://localhost/wp3/22-revision-v1', 0, 'revision', '', 0),
(27, 1, '2015-04-16 14:11:45', '2015-04-16 14:11:45', 'post in SUBCAT', 'post in SUBCAT', '', 'inherit', 'open', 'open', '', '15-revision-v1', '', '', '2015-04-16 14:11:45', '2015-04-16 14:11:45', '', 15, 'http://localhost/wp3/15-revision-v1', 0, 'revision', '', 0),
(28, 1, '2015-04-16 14:39:30', '2015-04-16 14:39:30', 'eng cust post in ROOT', 'CUST_POST ROOT(eng) under ROOTCAT(eng)', '', 'inherit', 'open', 'open', '', '18-revision-v1', '', '', '2015-04-16 14:39:30', '2015-04-16 14:39:30', '', 18, 'http://localhost/wp3/18-revision-v1', 0, 'revision', '', 0),
(29, 1, '2015-04-16 14:40:56', '2015-04-16 14:40:56', 'eng sub CUST in sub', 'CUST_POST sub-ROOT(eng-sub) under ROOTCAT(eng)', '', 'inherit', 'open', 'open', '', '24-revision-v1', '', '', '2015-04-16 14:40:56', '2015-04-16 14:40:56', '', 24, 'http://localhost/wp3/24-revision-v1', 0, 'revision', '', 0),
(30, 1, '2015-04-16 14:41:23', '2015-04-16 14:41:23', 'sub  CUSTpost in ROOTCAR', 'CUST_POST ROOT(eng-sub) under ROOTCAT(eng)', '', 'inherit', 'open', 'open', '', '22-revision-v1', '', '', '2015-04-16 14:41:23', '2015-04-16 14:41:23', '', 22, 'http://localhost/wp3/22-revision-v1', 0, 'revision', '', 0),
(31, 1, '2015-04-16 14:43:20', '2015-04-16 14:43:20', 'samplee', 'ROOTPAGE(eng)', '', 'inherit', 'open', 'open', '', '4-revision-v1', '', '', '2015-04-16 14:43:20', '2015-04-16 14:43:20', '', 4, 'http://localhost/wp3/4-revision-v1', 0, 'revision', '', 0),
(32, 1, '2015-04-16 14:43:39', '2015-04-16 14:43:39', 'samplee', 'SubPAGE(eng-sub) of ROOTPAGE', '', 'inherit', 'open', 'open', '', '5-revision-v1', '', '', '2015-04-16 14:43:39', '2015-04-16 14:43:39', '', 5, 'http://localhost/wp3/5-revision-v1', 0, 'revision', '', 0),
(33, 1, '2015-04-16 14:43:59', '2015-04-16 14:43:59', 'sdasd', 'SUBpage(eng) of ROOTPAGE(eng)', '', 'publish', 'open', 'open', '', 'eng', '', '', '2015-04-16 14:44:19', '2015-04-16 14:44:19', '', 4, 'http://localhost/wp3/?page_id=33', 0, 'page', '', 0),
(34, 1, '2015-04-16 14:43:59', '2015-04-16 14:43:59', 'sdasd', 'eng', '', 'inherit', 'open', 'open', '', '33-revision-v1', '', '', '2015-04-16 14:43:59', '2015-04-16 14:43:59', '', 33, 'http://localhost/wp3/33-revision-v1', 0, 'revision', '', 0),
(35, 1, '2015-04-16 14:44:19', '2015-04-16 14:44:19', 'sdasd', 'SUBpage(eng) of ROOTPAGE(eng)', '', 'inherit', 'open', 'open', '', '33-revision-v1', '', '', '2015-04-16 14:44:19', '2015-04-16 14:44:19', '', 33, 'http://localhost/wp3/33-revision-v1', 0, 'revision', '', 0),
(36, 1, '2015-04-16 14:47:45', '2015-04-16 14:47:45', 'post in SUBCAT', 'ROOT_POST(eng-sub) under ROOTCAT(eng)', '', 'inherit', 'open', 'open', '', '15-revision-v1', '', '', '2015-04-16 14:47:45', '2015-04-16 14:47:45', '', 15, 'http://localhost/wp3/15-revision-v1', 0, 'revision', '', 0),
(37, 1, '2015-04-16 14:48:00', '2015-04-16 14:48:00', 'eng posttttt', 'ROOT_POST(eng) under ROOTCAT(eng)', '', 'inherit', 'open', 'open', '', '12-revision-v1', '', '', '2015-04-16 14:48:00', '2015-04-16 14:48:00', '', 12, 'http://localhost/wp3/12-revision-v1', 0, 'revision', '', 0),
(38, 1, '2015-04-16 17:54:03', '2015-04-16 17:54:03', 'Welcome to WordPress. This is your first post. Edit or delete it, then start blogging!', 'Hello world!', '', 'inherit', 'open', 'open', '', '1-revision-v1', '', '', '2015-04-16 17:54:03', '2015-04-16 17:54:03', '', 1, 'http://localhost/wp3/1-revision-v1', 0, 'revision', '', 0),
(39, 1, '2015-04-16 18:16:38', '2015-04-16 18:16:38', 'htrhrth', 'htrthrth', '', 'publish', 'open', 'open', '', 'htrthrth', '', '', '2015-04-16 18:19:32', '2015-04-16 18:19:32', '', 0, 'http://localhost/wp3/?post_type=eng&#038;p=39', 0, 'eng', '', 0),
(40, 1, '2015-04-16 18:16:38', '2015-04-16 18:16:38', 'htrhrth', 'htrthrth', '', 'inherit', 'open', 'open', '', '39-revision-v1', '', '', '2015-04-16 18:16:38', '2015-04-16 18:16:38', '', 39, 'http://localhost/wp3/39-revision-v1', 0, 'revision', '', 0),
(41, 1, '2015-04-19 16:43:27', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 16:43:27', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=41', 0, 'eng', '', 0),
(42, 1, '2015-04-19 17:15:57', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 17:15:57', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=42', 0, 'eng', '', 0),
(43, 1, '2015-04-19 17:16:23', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 17:16:23', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=43', 0, 'eng', '', 0),
(44, 1, '2015-04-19 17:18:28', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 17:18:28', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=44', 0, 'eng', '', 0),
(45, 1, '2015-04-19 17:20:35', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 17:20:35', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=45', 0, 'eng', '', 0),
(46, 1, '2015-04-19 17:21:14', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 17:21:14', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=46', 0, 'eng', '', 0),
(47, 1, '2015-04-19 17:21:31', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 17:21:31', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=47', 0, 'eng', '', 0),
(48, 1, '2015-04-19 17:22:02', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 17:22:02', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=48', 0, 'eng', '', 0),
(49, 1, '2015-04-19 17:22:04', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 17:22:04', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=49', 0, 'eng', '', 0),
(50, 1, '2015-04-19 17:32:57', '2015-04-19 17:32:57', 'uykyukyuk', 'ukuk', '', 'publish', 'open', 'open', '', 'ukuk', '', '', '2015-04-19 17:35:27', '2015-04-19 17:35:27', '', 0, 'http://localhost/wp3/?post_type=eng&#038;p=50', 0, 'eng', '', 0),
(51, 1, '2015-04-19 17:32:57', '2015-04-19 17:32:57', 'uykyukyuk', 'ukuk', '', 'inherit', 'open', 'open', '', '50-revision-v1', '', '', '2015-04-19 17:32:57', '2015-04-19 17:32:57', '', 50, 'http://localhost/wp3/50-revision-v1', 0, 'revision', '', 0),
(52, 1, '2015-04-19 17:58:21', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 17:58:21', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=52', 0, 'eng', '', 0),
(53, 1, '2015-04-19 17:58:34', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 17:58:34', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=53', 0, 'eng', '', 0),
(54, 1, '2015-04-19 17:58:52', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 17:58:52', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=54', 0, 'eng', '', 0),
(55, 1, '2015-04-19 17:59:27', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 17:59:27', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=55', 0, 'eng', '', 0),
(56, 1, '2015-04-19 17:59:58', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 17:59:58', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=56', 0, 'eng', '', 0),
(57, 1, '2015-04-19 18:00:08', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 18:00:08', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=57', 0, 'eng', '', 0),
(58, 1, '2015-04-19 18:00:55', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 18:00:55', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=58', 0, 'eng', '', 0),
(59, 1, '2015-04-19 18:01:17', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 18:01:17', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=59', 0, 'eng', '', 0),
(60, 1, '2015-04-19 18:01:23', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 18:01:23', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=60', 0, 'eng', '', 0),
(61, 1, '2015-04-19 18:02:25', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 18:02:25', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=61', 0, 'eng', '', 0),
(62, 1, '2015-04-19 18:03:08', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 18:03:08', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=62', 0, 'eng', '', 0),
(63, 1, '2015-04-19 18:04:17', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 18:04:17', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=63', 0, 'eng', '', 0),
(64, 1, '2015-04-19 18:05:45', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 18:05:45', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=64', 0, 'eng', '', 0),
(65, 1, '2015-04-19 18:09:17', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 18:09:17', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=65', 0, 'eng', '', 0),
(66, 1, '2015-04-19 18:10:23', '2015-04-19 18:10:23', 'gegegewg', 'gege', '', 'publish', 'open', 'open', '', 'gege', '', '', '2015-04-19 18:10:23', '2015-04-19 18:10:23', '', 0, 'http://localhost/wp3/?post_type=eng&#038;p=66', 0, 'eng', '', 0),
(67, 1, '2015-04-19 18:10:23', '2015-04-19 18:10:23', 'gegegewg', 'gege', '', 'inherit', 'open', 'open', '', '66-revision-v1', '', '', '2015-04-19 18:10:23', '2015-04-19 18:10:23', '', 66, 'http://localhost/wp3/66-revision-v1', 0, 'revision', '', 0),
(68, 1, '2015-04-19 18:10:29', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-19 18:10:29', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=68', 0, 'eng', '', 0),
(69, 1, '2015-04-20 08:55:19', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2015-04-20 08:55:19', '0000-00-00 00:00:00', '', 0, 'http://localhost/wp3/?post_type=eng&p=69', 0, 'eng', '', 0),
(70, 1, '2015-04-20 09:08:00', '2015-04-20 09:08:00', '<p>samplee</p>\n', 'SubPAGE(eng-sub) of ROOTPAGE', '', 'inherit', 'open', 'open', '', '5-autosave-v1', '', '', '2015-04-20 09:08:00', '2015-04-20 09:08:00', '', 5, 'http://localhost/wp3/uncategorized/5-autosave-v1', 0, 'revision', '', 0),
(71, 1, '2015-04-20 09:12:22', '2015-04-20 09:12:22', '<strong><a class="row-title" title="Edit “CUST_POST sub-ROOT(eng-sub) under ROOTCAT(eng)”" href="http://localhost/wp3/wp-admin/post.php?post=24&amp;action=edit">CUST_POST sub-ROOT(eng-sub) under ROOTCAT(eng)</a></strong>', 'CUST_POST ROOT(eng-sub) under ROOTCAT(eng)', '', 'publish', 'open', 'open', '', 'eng-sub-2', '', '', '2015-04-20 09:12:22', '2015-04-20 09:12:22', '', 0, 'http://localhost/wp3/?post_type=eng&#038;p=71', 0, 'eng', '', 0),
(72, 1, '2015-04-20 09:12:22', '2015-04-20 09:12:22', '<strong><a class="row-title" title="Edit “CUST_POST sub-ROOT(eng-sub) under ROOTCAT(eng)”" href="http://localhost/wp3/wp-admin/post.php?post=24&amp;action=edit">CUST_POST sub-ROOT(eng-sub) under ROOTCAT(eng)</a></strong>', 'CUST_POST ROOT(eng-sub) under ROOTCAT(eng)', '', 'inherit', 'open', 'open', '', '71-revision-v1', '', '', '2015-04-20 09:12:22', '2015-04-20 09:12:22', '', 71, 'http://localhost/wp3/uncategorized/71-revision-v1', 0, 'revision', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_terms`
--

CREATE TABLE IF NOT EXISTS `wp_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  KEY `slug` (`slug`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `wp_terms`
--

INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Uncategorized', 'uncategorized', 0),
(2, 'ROOTCAT(eng)', 'eng', 0),
(3, 'SUBCAT of ROOTCAR(eng-sub)', 'eng-sub', 0),
(4, 'rus', 'rus', 0),
(5, 'my-sub-categ', 'my-sub-categ', 0),
(6, 'CUSTCATEG ROOT (eng-sub)', 'eng-sub', 0),
(7, 'CUSTCATEG ROOT(eng)', 'eng', 0),
(8, 'CUSTOMsubcateg(eng-sub) of CUSTcateg(eng)', 'eng-sub-2', 0),
(9, 'htrthrth', 'htrthrth', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_relationships`
--

CREATE TABLE IF NOT EXISTS `wp_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_term_relationships`
--

INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0),
(1, 3, 0),
(12, 2, 0),
(15, 2, 0),
(18, 2, 0),
(18, 6, 0),
(18, 7, 0),
(18, 8, 0),
(22, 2, 0),
(24, 2, 0),
(71, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_taxonomy`
--

CREATE TABLE IF NOT EXISTS `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `wp_term_taxonomy`
--

INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 1),
(2, 2, 'category', '', 0, 5),
(3, 3, 'category', '', 2, 1),
(4, 4, 'category', '', 0, 0),
(5, 5, 'category', '', 4, 0),
(6, 6, 'eng', '', 0, 1),
(7, 7, 'eng', '', 0, 1),
(8, 8, 'eng', '', 7, 1),
(9, 9, 'eng', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_usermeta`
--

CREATE TABLE IF NOT EXISTS `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `wp_usermeta`
--

INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'nickname', 'wp322'),
(2, 1, 'first_name', ''),
(3, 1, 'last_name', ''),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'comment_shortcuts', 'false'),
(7, 1, 'admin_color', 'fresh'),
(8, 1, 'use_ssl', '0'),
(9, 1, 'show_admin_bar_front', 'true'),
(10, 1, 'wp_capabilities', 'a:1:{s:13:"administrator";b:1;}'),
(11, 1, 'wp_user_level', '10'),
(12, 1, 'dismissed_wp_pointers', 'wp360_locks,wp390_widgets,wp410_dfw'),
(13, 1, 'show_welcome_panel', '1'),
(14, 1, 'session_tokens', 'a:2:{s:64:"8ec26ecb968b6d952fd63785d3962a1fd1dc885c2c886fc84236e4246342f531";a:4:{s:10:"expiration";i:1430397520;s:2:"ip";s:9:"127.0.0.1";s:2:"ua";s:72:"Mozilla/5.0 (Windows NT 6.1; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0";s:5:"login";i:1429187920;}s:64:"4becd732fd79b3670a05ac73fd6527d5614136d5dd5d6db07d0284fdc6dd4920";a:4:{s:10:"expiration";i:1430397552;s:2:"ip";s:9:"127.0.0.1";s:2:"ua";s:72:"Mozilla/5.0 (Windows NT 6.1; WOW64; rv:37.0) Gecko/20100101 Firefox/37.0";s:5:"login";i:1429187952;}}'),
(15, 1, 'wp_user-settings', 'hidetb=1&editor=tinymce&libraryContent=browse'),
(16, 1, 'wp_user-settings-time', '1429187916'),
(17, 1, 'wp_dashboard_quick_press_last_post_id', '3'),
(18, 1, 'closedpostboxes_eng', 'a:0:{}'),
(19, 1, 'metaboxhidden_eng', 'a:1:{i:0;s:7:"slugdiv";}');

-- --------------------------------------------------------

--
-- Table structure for table `wp_users`
--

CREATE TABLE IF NOT EXISTS `wp_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wp_users`
--

INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'wp322', '$P$BvKcmIBD7NZ5Fp7mA7YAkg0vYKDM.F.', 'wp322', 'ee@eee.rrhth', '', '2015-04-16 12:38:17', '', 0, 'wp322');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
