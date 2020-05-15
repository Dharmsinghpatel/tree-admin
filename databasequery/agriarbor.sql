-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2020 at 06:01 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agriarbor`
--

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `link` varchar(250) DEFAULT NULL,
  `file_id` int(11) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`id`, `title`, `link`, `file_id`, `description`, `created`, `updated`, `position`) VALUES
(5, 'slide 1', '197', 203, ' Goat', '2020-05-09 09:54:47', '0000-00-00 00:00:00', 1),
(6, 'Cow', '207', 204, ' ', '2020-05-09 09:55:10', '0000-00-00 00:00:00', 2),
(8, 'Slide 3', '198', 205, ' ', '2020-05-09 10:02:18', '0000-00-00 00:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `classification`
--

CREATE TABLE `classification` (
  `id` int(11) NOT NULL,
  `type` enum('crop','animal','fertilizer','pesticides','all') NOT NULL,
  `name` varchar(250) NOT NULL,
  `use_in` varchar(250) NOT NULL,
  `document_id` int(11) DEFAULT NULL,
  `resource_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classification`
--

INSERT INTO `classification` (`id`, `type`, `name`, `use_in`, `document_id`, `resource_id`) VALUES
(67, 'crop', 'Wheat', 'Eat', 197, NULL),
(68, 'crop', 'Colififolwer', 'Eat', 198, NULL),
(69, 'crop', 'Wheat', 'Eat', 199, NULL),
(70, 'fertilizer', 'Compost', 'Farm', 200, NULL),
(71, 'fertilizer', 'Compost', 'home', 201, NULL),
(72, 'pesticides', 'Pertricide', 'farm', 202, NULL),
(73, 'pesticides', 'Petricide', 'Farm', 203, NULL),
(74, 'animal', 'Cow', 'milk', 204, NULL),
(75, 'fertilizer', 'Compost', 'farm', 205, NULL),
(76, 'animal', 'Goat', 'milk', 206, NULL),
(77, 'crop', 'wheat', 'farm', 207, NULL),
(78, 'fertilizer', 'compost', 'farm', 208, NULL),
(79, 'animal', 'Baffalo', 'milk', 212, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `resource_id` int(11) DEFAULT NULL,
  `document_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `type` enum('topic','file','description') NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `description`, `resource_id`, `document_id`, `topic_id`, `type`, `position`) VALUES
(520, NULL, 19, 197, NULL, 'file', 1),
(521, '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n', NULL, 197, NULL, 'description', 2),
(522, NULL, 20, 198, NULL, 'file', 1),
(523, '<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n', NULL, 198, NULL, 'description', 2),
(524, '<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n', NULL, 199, NULL, 'description', 1),
(525, '<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n', NULL, 200, NULL, 'description', 1),
(526, NULL, 21, 200, NULL, 'file', 2),
(527, NULL, 22, 201, NULL, 'file', 1),
(528, '<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n', NULL, 201, NULL, 'description', 2),
(531, '<p>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>\r\n', NULL, 203, NULL, 'description', 1),
(532, NULL, 26, 203, NULL, 'file', 2),
(535, '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n', NULL, 205, NULL, 'description', 1),
(536, NULL, 22, 205, NULL, 'file', 2),
(537, '<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n', NULL, 206, NULL, 'description', 1),
(538, NULL, 22, 206, NULL, 'file', 2),
(539, '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n', NULL, 207, NULL, 'description', 1),
(540, NULL, 27, 207, NULL, 'file', 2),
(541, '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n', NULL, 208, NULL, 'description', 1),
(545, NULL, 24, 202, NULL, 'file', 1),
(546, '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n', NULL, 202, NULL, 'description', 2),
(549, 'topic 1', NULL, 204, 209, 'topic', 3),
(550, 'topic 2', NULL, 204, 210, 'topic', 4),
(553, '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n', NULL, 204, NULL, 'description', 1),
(554, NULL, 24, 204, NULL, 'file', 2),
(555, '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n', NULL, 204, NULL, 'description', 5),
(556, 'Topic 3', NULL, 204, 211, 'topic', 6),
(557, NULL, 34, 204, NULL, 'file', 7),
(558, NULL, 33, 204, NULL, 'file', 8),
(559, '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n', NULL, 204, NULL, 'description', 9),
(560, '<h2>Where can I get some?</h2>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td rowspan=\"2\">&nbsp;</td>\r\n			<td rowspan=\"2\">\r\n			<table>\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>paragraphs</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>words</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>bytes</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>lists</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n			<td>&nbsp;</td>\r\n			<td>Start with &#39;Lorem<br />\r\n			ipsum dolor sit amet...&#39;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, 209, NULL, 'description', 1),
(561, NULL, 27, 209, NULL, 'file', 2),
(562, '<h2>Where can I get some?</h2>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td rowspan=\"2\">&nbsp;</td>\r\n			<td rowspan=\"2\">\r\n			<table>\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>paragraphs</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>words</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>bytes</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>lists</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n			<td>&nbsp;</td>\r\n			<td>Start with &#39;Lorem<br />\r\n			ipsum dolor sit amet...&#39;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, 209, NULL, 'description', 3),
(563, NULL, 34, 209, NULL, 'file', 4);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `icon` int(11) DEFAULT NULL,
  `type` enum('info','news','document') DEFAULT NULL,
  `is_topic` tinyint(4) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `title`, `icon`, `type`, `is_topic`, `position`, `created`, `updated`) VALUES
(197, 'What is Lorem Ipsum?', 192, 'info', NULL, 1, '2020-05-09 09:33:43', NULL),
(198, '1914 translation by H. Rackham', 193, 'info', NULL, 2, '2020-05-09 09:35:17', NULL),
(199, 'Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC', 194, 'info', NULL, 3, '2020-05-09 09:36:18', NULL),
(200, '1914 translation by H. Rackham', 195, 'news', NULL, 1, '2020-05-09 09:40:36', NULL),
(201, 'Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC', 196, 'news', NULL, 3, '2020-05-09 09:42:56', NULL),
(202, '1914 translation by H. Rackham', 197, 'news', NULL, 2, '2020-05-09 09:45:19', '2020-05-10 07:47:38'),
(203, 'The standard Lorem Ipsum passage, used since the 1500s', 198, 'news', NULL, 4, '2020-05-09 09:46:40', NULL),
(204, 'Section 1.10.32 of ', 199, 'document', NULL, 8, '2020-05-09 09:50:28', '2020-05-11 03:17:02'),
(205, 'Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC', 200, 'document', NULL, 9, '2020-05-09 09:51:31', NULL),
(206, '1914 translation by H. Rackham', 201, 'document', NULL, 10, '2020-05-09 09:52:37', NULL),
(207, 'Where can I get some?', 202, 'document', NULL, 11, '2020-05-09 09:54:07', NULL),
(208, 'Where does it come from?Where does it come from?', 206, 'info', NULL, 12, '2020-05-10 07:42:53', NULL),
(209, 'topic 1', 207, 'info', 1, NULL, '2020-05-11 03:17:02', '2020-05-11 04:29:22'),
(210, 'topic 2', NULL, NULL, 1, NULL, '2020-05-11 03:17:02', NULL),
(211, 'Topic 3', NULL, NULL, 1, NULL, '2020-05-11 03:17:02', NULL),
(212, 'This is verbal Info', 227, 'info', NULL, 13, '2020-05-12 10:50:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `unique_name` varchar(500) NOT NULL,
  `size` smallint(6) NOT NULL,
  `type` enum('image','site','video') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `file_name`, `unique_name`, `size`, `type`) VALUES
(168, 'Screenshot_from_2020-03-26_22-08-11.png', 'b6ef78b2deaf5876997c7b8ac83efcb4.png', 193, 'image'),
(172, 'Video 1', 'iIBDZkIOuJU', 28, 'video'),
(173, 'agriculture-basil-bunch-cultivation.jpg', 'e425b0cbb01c07a65138cd60c12afd36.jpg', 90, 'image'),
(174, 'Video 2', 'FyOzeO6fQwI', 28, 'video'),
(175, 'cropland.jpg', '7f3f3ccada37ab2e368e30951837c035.jpg', 78, 'image'),
(176, 'Video 3', 'hMHv5fwSY8k', 28, 'video'),
(177, 'green-wheat-field.jpg', 'ab7035b91337a1fa67c44cf5e68943c6.jpg', 68, 'image'),
(178, 'video 3', 'hMHv5fwSY8k', 28, 'video'),
(179, 'agriculture-basil-bunch-cultivation.jpg', '4bea60c4abbfd71b2d7a20b9fda20bed.jpg', 90, 'image'),
(180, 'Video 4', 'hMHv5fwSY8k', 28, 'video'),
(181, 'agriculture-basil-bunch-cultivation.jpg', '035bb24c6fb507e43568867ee55040f5.jpg', 90, 'image'),
(182, 'Video 5', 'hMHv5fwSY8k', 28, 'video'),
(183, 'cropland.jpg', '9fcffbc4372c6a85825f97d31bd7a7b2.jpg', 78, 'image'),
(184, 'Video 6', 'hMHv5fwSY8k', 28, 'video'),
(185, 'green-wheat-field.jpg', 'f954e2ed96812ca8a386ba10b69285e6.jpg', 68, 'image'),
(186, 'Video 7', 'hMHv5fwSY8k', 28, 'video'),
(187, 'agriculture-basil-bunch-cultivation.jpg', '5c6e72cb2b4039ab8890e5daeb3126eb.jpg', 90, 'image'),
(188, 'Video 8', 'hMHv5fwSY8k', 28, 'video'),
(189, 'agriculture-basil-bunch-cultivation.jpg', 'be1a774cfc01d8807f95ca074016a051.jpg', 90, 'image'),
(190, 'Video 9', 'hMHv5fwSY8k', 28, 'video'),
(191, 'cropland.jpg', '97d48874ff5fe14a8d9a4075e6916905.jpg', 78, 'image'),
(192, 'cropland.jpg', '6ff4ad44e7b21486193419a4a88154ff.jpg', 78, 'image'),
(193, 'agriculture-basil-bunch-cultivation.jpg', '14253d3e5c39d449f6dc82bb72adac68.jpg', 90, 'image'),
(194, 'green-wheat-field.jpg', 'db3029e8ce035a7af48be614c3608edf.jpg', 68, 'image'),
(195, 'noncompost.jpeg', '47ffe48df78e9a5058b74143d3cccfc3.jpeg', 9, 'image'),
(196, 'compost1.jpeg', '349539f257a7084f80488c601596f48e.jpeg', 14, 'image'),
(197, 'petricide1.jpeg', '2e62b3c5c0ad25e624b2cdf2ef5a9005.jpeg', 7, 'image'),
(198, 'perticide2.jpeg', '2e527a9c983325166c18be1625c630fb.jpeg', 13, 'image'),
(199, 'cow.jpg', '8ca57b1214b94a0efb6b8c34175d1a60.jpg', 45, 'image'),
(200, 'noncompost.jpeg', '6369aa084e452dd2d064941c2b310cb1.jpeg', 9, 'image'),
(201, 'goat.jpeg', '017d92092422809f0c41067dfd09653d.jpeg', 96, 'image'),
(202, 'perticide2.jpeg', '5c5f9866635117aa808766ae9fbc89b2.jpeg', 13, 'image'),
(203, 'goat.jpeg', 'b504d9bacf434888ca118d90bf72c7a7.jpeg', 96, 'image'),
(204, 'cow.jpg', '503f98074d3d47c83286184ba547a104.jpg', 45, 'image'),
(205, 'petricide1.jpeg', '38adce0f849c4ad27683dbc01e8ac8eb.jpeg', 7, 'image'),
(206, 'compost1.jpeg', 'f5531c2c5d21fa9716d456d78145429f.jpeg', 14, 'image'),
(207, 'goat.jpeg', '8c09701bcc5d5c4cbbf282a872d0c69a.jpeg', 96, 'image'),
(214, 'site 2', 'https://www.lipsum.com/', 23, 'site'),
(215, 'site 2', 'https://www.lipsum.com/', 23, 'site'),
(216, 'goat.jpeg', '730c2da9a8d6dab2b30fa4d5097f0442.jpeg', 96, 'image'),
(217, 'Video 10', '_hMqGwhUJ4c', 11, 'video'),
(218, 'Video 10', '_hMqGwhUJ4c', 11, 'video'),
(219, 'Video 10', '_hMqGwhUJ4c', 11, 'video'),
(220, 'Video 10', '_hMqGwhUJ4c', 11, 'video'),
(221, 'Video 10', '_hMqGwhUJ4c', 11, 'video'),
(222, 'Video 10', '_hMqGwhUJ4c', 11, 'video'),
(223, 'Video 10', '_hMqGwhUJ4c', 11, 'video'),
(224, 'cow.jpg', '960e2e756e22feba1bffd7b595bb0ebc.jpg', 45, 'image'),
(225, 'Video 10', '_hMqGwhUJ4c', 11, 'video'),
(226, 'cow.jpg', 'a290498a97de730659bbbe6212b7ad29.jpg', 45, 'image'),
(227, 'goat.jpeg', 'da106cb45942006422aa4822bea316f0.jpeg', 96, 'image');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(20) NOT NULL,
  `title` varchar(250) NOT NULL,
  `type` enum('video','image','site') NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `file_id_2` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `position` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `title`, `type`, `file_id`, `file_id_2`, `description`, `created`, `position`) VALUES
(19, 'Video 1', 'video', 172, 173, ' https://youtu.be/iIBDZkIOuJU', NULL, 2),
(20, 'Video 2', 'video', 174, 175, 'https://youtu.be/FyOzeO6fQwI', NULL, 3),
(21, 'Video 3', 'video', 176, 177, ' https://youtu.be/hMHv5fwSY8k', NULL, 4),
(22, 'video 3', 'video', 178, 179, ' https://youtu.be/hMHv5fwSY8k', NULL, 5),
(23, 'Video 4', 'video', 180, 181, ' https://youtu.be/hMHv5fwSY8k', NULL, 6),
(24, 'Video 5', 'video', 182, 183, ' https://youtu.be/hMHv5fwSY8k', NULL, 7),
(25, 'Video 6', 'video', 184, 185, ' https://youtu.be/hMHv5fwSY8k', NULL, 8),
(26, 'Video 7', 'video', 186, 187, 'https://youtu.be/hMHv5fwSY8k ', NULL, 9),
(27, 'Video 8', 'video', 188, 189, ' https://youtu.be/hMHv5fwSY8k', NULL, 10),
(28, 'Video 9', 'video', 190, 191, 'https://youtu.be/hMHv5fwSY8k ', NULL, 11),
(33, 'site 2', 'site', 215, NULL, ' https://www.lipsum.com/', NULL, 12),
(34, 'Image 1', 'image', 216, NULL, ' ', NULL, 13),
(35, 'Video 10', 'image', 226, 224, 'This is link video with id  ', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_id` text NOT NULL,
  `file_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_id`, `file_id`, `name`, `password`, `created`, `updated`) VALUES
(2, 'ee4e528ca67749dc54222bf10d64f29b037c6c70e39c1c4392f707fc59ac7792e804e447005b64d49ad3f2f31f1de66b38372c508b631606fe52fc00b74c19d5aMTLWTbbkMkxdYv+fqLqjonj8eWrJBWlDDIePjnBWYQPoyyteZ6bGZ1Oct8lS4T0', 168, 'cfc2b866b991723e7adeb9b18b42174973f0231716593ebd9bb797fc9d0f8057ff86a5e29ae668a04b6d8262f5508960959c77bbe56cc8febe89b134c79b8f50nPOK1h9I6ai6PHg320EA3zLZnOCbQQ8cy5zVqG8tKbc=', 'bee6b172d922ff1066d21206a2141e2d8aca4a1e1400e1e37800651b789b4ba2164c2d1cba2fb01f2c40301fce0149eb3fafbbff2b2648132edf4e76d9a198e0K1S07PqenXNe51gg3kdRh3djt9GfRjxI2gl92wwSPdFqL38TiukOSvRXo9AYuZpMyEy1j1FABLyG0wZ26BOiLg==', '2020-05-06 10:19:12', '2020-05-07 08:04:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classification`
--
ALTER TABLE `classification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resource_id` (`resource_id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `document_id` (`document_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_id` (`file_id`),
  ADD KEY `file_id_2` (`file_id_2`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_id` (`file_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `classification`
--
ALTER TABLE `classification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=564;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `contents_ibfk_2` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`),
  ADD CONSTRAINT `contents_ibfk_3` FOREIGN KEY (`topic_id`) REFERENCES `documents` (`id`),
  ADD CONSTRAINT `contents_ibfk_4` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`);

--
-- Constraints for table `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resources_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`),
  ADD CONSTRAINT `resources_ibfk_2` FOREIGN KEY (`file_id_2`) REFERENCES `files` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
