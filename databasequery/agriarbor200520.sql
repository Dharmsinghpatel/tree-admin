-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 20, 2020 at 07:13 AM
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
-- Table structure for table `analytic`
--

CREATE TABLE `analytic` (
  `id` int(11) NOT NULL,
  `display_type` enum('video','document','news','info','dashboard') NOT NULL,
  `views_count` int(11) DEFAULT NULL,
  `product_type` enum('animal','crop','fertilizer','pesticides','none') NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `analytic`
--

INSERT INTO `analytic` (`id`, `display_type`, `views_count`, `product_type`, `created`) VALUES
(1, 'video', 3, 'animal', '2020-05-13'),
(3, 'document', 3, 'animal', '2020-05-13'),
(4, 'document', 1, 'crop', '2020-05-13'),
(5, 'news', 2, 'fertilizer', '2020-05-13'),
(6, 'info', 1, 'crop', '2020-05-13'),
(7, 'document', 5, 'fertilizer', '2020-05-14'),
(8, 'document', 9, 'animal', '2020-05-14'),
(9, 'document', 1, 'crop', '2020-05-14'),
(10, 'video', 2, 'animal', '2020-05-14'),
(12, 'info', 1, 'crop', '2020-05-14'),
(13, 'info', 1, 'animal', '2020-05-14'),
(14, 'video', 1, 'crop', '2020-05-14'),
(16, 'dashboard', 9, 'none', '2020-05-14'),
(17, 'dashboard', 51, 'none', '2020-05-15'),
(18, 'document', 1, 'crop', '2020-05-15'),
(19, 'dashboard', 30, 'none', '2020-05-16'),
(20, 'news', 3, 'pesticides', '2020-05-16'),
(21, 'document', 5, 'crop', '2020-05-16'),
(22, 'video', 1, 'fertilizer', '2020-05-16'),
(23, 'document', 5, 'animal', '2020-05-16'),
(24, 'document', 1, 'fertilizer', '2020-05-16'),
(25, 'info', 1, 'animal', '2020-05-16'),
(26, 'info', 1, 'crop', '2020-05-16'),
(27, 'video', 1, 'crop', '2020-05-16'),
(28, 'dashboard', 65, 'none', '2020-05-17'),
(29, 'document', 11, 'crop', '2020-05-17'),
(30, 'document', 1, 'animal', '2020-05-17'),
(31, 'video', 2, 'crop', '2020-05-17'),
(32, 'document', 6, 'fertilizer', '2020-05-17'),
(33, 'info', 4, 'crop', '2020-05-17'),
(34, 'info', 32, 'animal', '2020-05-17'),
(35, 'video', 1, 'animal', '2020-05-17'),
(36, 'news', 5, 'pesticides', '2020-05-17'),
(37, 'video', 1, 'fertilizer', '2020-05-17'),
(38, 'dashboard', 3, 'none', '2020-05-18'),
(39, 'video', 1, 'fertilizer', '2020-05-18'),
(40, 'info', 2, 'crop', '2020-05-18'),
(41, 'info', 17, 'animal', '2020-05-18'),
(42, 'dashboard', 13, 'none', '2020-05-20'),
(43, 'info', 1, 'animal', '2020-05-20');

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
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`id`, `title`, `link`, `file_id`, `description`, `created`, `updated`, `start_date`, `end_date`, `position`) VALUES
(5, 'slide 1', 'https://stackoverflow.com/questions/52240123/how-to-open-link-in-new-tab-in-angular-5', 203, ' Goat        ', '2020-05-09 09:54:47', '2020-05-17 12:28:04', '2020-05-16', '2020-05-16', 1),
(6, 'Cow', 'Where can I get some?', 204, '               ', '2020-05-09 09:55:10', '2020-05-17 03:19:04', '2020-05-15', '2020-05-20', 1),
(8, 'Slide 3', '1914 translation by H. Rackham', 205, '     This is show time ', '2020-05-09 10:02:18', '2020-05-16 02:35:01', '2020-05-08', '2020-05-23', 2),
(9, 'This is image', '200', 263, '  \r\nThis is show piece      ', '2020-05-16 11:56:01', '2020-05-16 02:13:40', '2020-05-09', '2020-05-19', 3),
(10, 'This is last side', '', 264, '      ', '2020-05-16 12:58:20', '2020-05-17 03:02:36', '2020-05-16', '2020-05-20', 4),
(11, 'This is carousel after local', '202>1914 translation by H. Rackham</option><option  value=', 265, ' Ok this fine', '2020-05-17 03:24:12', '0000-00-00 00:00:00', '2020-05-13', '2020-05-22', 5);

-- --------------------------------------------------------

--
-- Table structure for table `classification`
--

CREATE TABLE `classification` (
  `id` int(11) NOT NULL,
  `product_type` enum('crop','animal','fertilizer','pesticides','all') NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_use` varchar(250) NOT NULL,
  `document_id` int(11) DEFAULT NULL,
  `resource_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classification`
--

INSERT INTO `classification` (`id`, `product_type`, `product_name`, `product_use`, `document_id`, `resource_id`) VALUES
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
(79, 'animal', 'Baffalo', 'milk', 212, NULL),
(80, 'animal', 'Goat ', 'Home', NULL, 36),
(82, 'animal', 'Goat', 'Home', 215, NULL),
(83, 'animal', 'Cow', 'Home', NULL, 37),
(84, 'pesticides', 'video 10', 'farm', NULL, 35),
(85, 'crop', 'corn', 'eat', NULL, 19),
(86, 'fertilizer', 'rice', 'food', NULL, 20),
(87, 'animal', 'ox', 'farming', NULL, 21),
(88, 'fertilizer', 'warmi', 'garden', NULL, 22),
(89, 'crop', 'banana', 'health', NULL, 23),
(90, 'fertilizer', 'grapes', 'wine', NULL, 24),
(91, 'animal', 'sheep', 'dung', NULL, 26),
(92, 'animal', 'e baffalo', 'fight', NULL, 27),
(93, 'fertilizer', 'compost', 'farm', NULL, 28),
(94, 'crop', 'trim', 'ok', NULL, 33),
(95, 'animal', 'not', 'ok', NULL, 34),
(97, 'animal', '', '', 220, NULL);

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
  `content_type` enum('topic','file','description','document') NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `description`, `resource_id`, `document_id`, `topic_id`, `content_type`, `position`) VALUES
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
(556, 'Topic 3', NULL, 204, 211, 'topic', 6),
(560, '<h2>Where can I get some?</h2>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td rowspan=\"2\">&nbsp;</td>\r\n			<td rowspan=\"2\">\r\n			<table>\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>paragraphs</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>words</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>bytes</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>lists</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n			<td>&nbsp;</td>\r\n			<td>Start with &#39;Lorem<br />\r\n			ipsum dolor sit amet...&#39;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, 209, NULL, 'description', 1),
(561, NULL, 27, 209, NULL, 'file', 2),
(562, '<h2>Where can I get some?</h2>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td rowspan=\"2\">&nbsp;</td>\r\n			<td rowspan=\"2\">\r\n			<table>\r\n				<tbody>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>paragraphs</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>words</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>bytes</td>\r\n					</tr>\r\n					<tr>\r\n						<td>&nbsp;</td>\r\n						<td>lists</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n			<td>&nbsp;</td>\r\n			<td>Start with &#39;Lorem<br />\r\n			ipsum dolor sit amet...&#39;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, 209, NULL, 'description', 3),
(563, NULL, 34, 209, NULL, 'file', 4),
(574, NULL, 19, 215, NULL, 'file', 1),
(575, NULL, 22, 215, NULL, 'file', 2),
(576, '<p>This not empty description</p>\r\n', NULL, 215, NULL, 'description', 3),
(583, '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n', NULL, 204, NULL, 'description', 1),
(584, NULL, 24, 204, NULL, 'file', 2),
(585, '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n', NULL, 204, NULL, 'description', 5),
(586, NULL, 34, 204, NULL, 'file', 7),
(587, NULL, 33, 204, NULL, 'file', 8),
(588, '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n', NULL, 204, NULL, 'description', 9),
(591, NULL, 19, 197, NULL, 'file', 1),
(592, '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n', NULL, 197, NULL, 'description', 2),
(593, 'topic 1', NULL, 197, 216, 'topic', 3),
(594, 'topic 2', NULL, 197, 217, 'topic', 4),
(620, 'topic 1', NULL, 220, 227, 'topic', 2),
(628, 'topic 1', NULL, 220, 228, 'topic', 4),
(641, 'topic 1', NULL, 220, 229, 'topic', 6),
(651, 'topic 6', NULL, 220, 230, 'topic', 7),
(658, 'topic 6', NULL, 220, 231, 'topic', 10),
(659, '1914 translation by H. Rackham', NULL, 220, 198, 'document', 1),
(660, '1914 translation by H. Rackham', NULL, 220, 198, 'document', 3),
(661, 'topic 1', NULL, 220, 228, 'document', 5),
(662, '1914 translation by H. Rackham', NULL, 220, 198, 'document', 8),
(663, 'Section 1.10.32 of ', NULL, 220, 204, 'document', 9),
(664, 'Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC', NULL, 220, 199, 'document', 11),
(665, '<h2>Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n', NULL, 220, NULL, 'description', 12);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `icon` int(11) DEFAULT NULL,
  `display_type` enum('info','news','document') DEFAULT NULL,
  `is_topic` tinyint(4) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `title`, `icon`, `display_type`, `is_topic`, `position`, `created`, `updated`) VALUES
(197, 'Topic 3', 192, 'document', 1, 1, '2020-05-18 10:16:05', '2020-05-16 02:40:57'),
(198, '1914 translation by H. Rackham', 193, 'info', NULL, 1, '2020-05-09 09:35:17', NULL),
(199, 'Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC', 194, 'info', NULL, 2, '2020-05-09 09:36:18', NULL),
(200, '1914 translation by H. Rackham', 195, 'news', NULL, 1, '2020-05-09 09:40:36', NULL),
(201, 'Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC', 196, 'news', NULL, 3, '2020-05-09 09:42:56', NULL),
(202, '1914 translation by H. Rackham', 197, 'news', NULL, 2, '2020-05-09 09:45:19', '2020-05-10 07:47:38'),
(203, 'The standard Lorem Ipsum passage, used since the 1500s', 198, 'news', NULL, 4, '2020-05-09 09:46:40', NULL),
(204, 'Section 1.10.32 of ', 199, 'info', NULL, 3, '2020-05-09 09:50:28', '2020-05-14 12:59:42'),
(205, 'Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC', 200, 'document', NULL, 2, '2020-05-09 09:51:31', NULL),
(206, '1914 translation by H. Rackham', 201, 'document', NULL, 3, '2020-05-09 09:52:37', NULL),
(207, 'Where can I get some?', 202, 'document', NULL, 4, '2020-05-09 09:54:07', NULL),
(208, 'Where does it come from?Where does it come from?', 206, 'info', NULL, 4, '2020-05-10 07:42:53', NULL),
(209, 'topic 1', 207, 'info', 1, NULL, '2020-05-14 12:59:42', '2020-05-11 04:29:22'),
(210, 'topic 2', NULL, NULL, 1, NULL, '2020-05-14 12:59:43', NULL),
(211, 'Topic 3', NULL, NULL, 1, NULL, '2020-05-14 12:59:43', NULL),
(212, 'This is verbal Info', 227, 'info', NULL, 5, '2020-05-12 10:50:07', NULL),
(215, 'This basic info', 231, 'info', NULL, 6, '2020-05-13 09:17:09', '2020-05-13 09:20:44'),
(216, 'topic 1', NULL, NULL, 1, NULL, '2020-05-16 02:40:57', NULL),
(217, 'topic 2', NULL, NULL, 1, NULL, '2020-05-16 02:40:58', NULL),
(220, 'document', 267, 'info', NULL, 7, '2020-05-18 09:38:35', '2020-05-18 11:29:51'),
(221, 'topic 1', NULL, NULL, 1, NULL, '2020-05-18 09:39:11', NULL),
(222, 'topic 2', NULL, NULL, 1, NULL, '2020-05-18 09:39:12', NULL),
(223, 'topic 1', NULL, NULL, 1, NULL, '2020-05-18 09:45:45', NULL),
(224, 'topic 1', NULL, NULL, 1, NULL, '2020-05-18 09:46:13', NULL),
(225, 'Topic 3', NULL, NULL, 1, NULL, '2020-05-18 09:58:40', NULL),
(226, 'topic 1', NULL, NULL, 1, NULL, '2020-05-18 10:18:05', NULL),
(227, 'topic 1', NULL, NULL, 1, NULL, '2020-05-18 11:29:51', NULL),
(228, 'topic 1', NULL, NULL, 1, NULL, '2020-05-18 11:29:51', NULL),
(229, 'topic 1', NULL, NULL, 1, NULL, '2020-05-18 11:29:51', NULL),
(230, 'topic 6', NULL, NULL, 1, NULL, '2020-05-18 11:29:51', NULL),
(231, 'topic 6', NULL, NULL, 1, NULL, '2020-05-18 11:29:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `is_read` tinyint(4) DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `first_name`, `last_name`, `email`, `comment`, `is_read`, `created`) VALUES
(4, 'First name', '', 'dharm@gustr.com', 'this is commemet', 1, '0000-00-00 00:00:00'),
(5, 'First name', '', 'dharm@gustr.com', 'this is commemet', 1, '0000-00-00 00:00:00'),
(6, 'First name', '', 'dharm@gustr.com', 'this is commemet', 1, '0000-00-00 00:00:00'),
(7, 'First name', '', 'dharm@gustr.com', 'this is commemet', 1, '0000-00-00 00:00:00'),
(8, 'rtrtre', '', 'dharm@gustr.com', 'dfgfdg', 1, '0000-00-00 00:00:00'),
(9, 'Dharmendra singh', '', 'dharm@gustr.com', 'this is comment for test', 1, '2020-05-16 02:24:16'),
(10, 'Smart6', '', 'dharm@gustr.com', 'This is show', 1, '2020-05-17 10:37:26');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `unique_name` varchar(500) NOT NULL,
  `size` smallint(6) NOT NULL,
  `file_type` enum('image','site','video') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `file_name`, `unique_name`, `size`, `file_type`) VALUES
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
(227, 'goat.jpeg', 'da106cb45942006422aa4822bea316f0.jpeg', 96, 'image'),
(228, 'goat.jpeg', '1db6e499a1c8b6cd0304de3d9bec2bfc.jpeg', 96, 'image'),
(229, 'goat.jpeg', 'efd0e0aaca33c0e622a0e02625a4ee31.jpeg', 96, 'image'),
(230, 'goat.jpeg', 'aaf7ff0532622cca7ca588bdd0ce6dff.jpeg', 96, 'image'),
(231, 'goat.jpeg', '2d1574c2435e81ef9bef4d1a8c08fdf7.jpeg', 96, 'image'),
(232, 'Video 1', 'iIBDZkIOuJU', 11, 'image'),
(233, 'Video 1', 'iIBDZkIOuJU', 11, 'image'),
(234, 'This is video', '_hMqGwhUJ4c', 11, 'image'),
(235, 'This is video', '_hMqGwhUJ4c', 11, 'image'),
(236, 'This is video', '_hMqGwhUJ4c', 11, 'image'),
(237, 'This is video', '_hMqGwhUJ4c', 11, 'image'),
(238, 'cow.jpg', '07dccc489d2bbd1223ff8e29507b8757.jpg', 45, 'image'),
(239, 'This is video', '_hMqGwhUJ4c', 11, 'image'),
(240, 'cow.jpg', '91f1b8aa48953af8872ef716633d7ba5.jpg', 45, 'image'),
(241, 'cow.jpg', '4d75a6dde2e3242490fd7c5f24309ce3.jpg', 45, 'image'),
(242, 'cow.jpg', 'b73a432864aa619f7f68d6ff18ff062c.jpg', 45, 'image'),
(243, 'This is video', '_hMqGwhUJ4c', 11, 'video'),
(244, 'cow.jpg', '806b61526e5f8d6d0108565e7e56324f.jpg', 45, 'image'),
(245, 'This is video', '_hMqGwhUJ4c', 11, 'video'),
(246, 'cow.jpg', '35c5dfec175a1fac64c3ff98872466ef.jpg', 45, 'image'),
(247, 'This is video', '_hMqGwhUJ4c', 11, 'video'),
(248, 'cow.jpg', 'b9076e0a961a4516621b76a4f6c566dd.jpg', 45, 'image'),
(249, 'Video 1', 'iIBDZkIOuJU', 11, 'video'),
(250, 'Video 3', 'hMHv5fwSY8k', 11, 'video'),
(251, 'video 3', 'hMHv5fwSY8k', 11, 'video'),
(252, 'video 3', 'hMHv5fwSY8k', 11, 'video'),
(253, 'Video 1', 'iIBDZkIOuJU', 11, 'video'),
(254, 'Video 2', 'FyOzeO6fQwI', 11, 'video'),
(255, 'Video 3', 'hMHv5fwSY8k', 11, 'video'),
(256, 'video 3', 'hMHv5fwSY8k', 11, 'video'),
(257, 'Video 4', 'hMHv5fwSY8k', 11, 'video'),
(258, 'Video 5', 'hMHv5fwSY8k', 11, 'video'),
(259, 'Video 7', 'hMHv5fwSY8k', 11, 'video'),
(260, 'Video 8', 'hMHv5fwSY8k', 11, 'video'),
(261, 'Video 9', 'hMHv5fwSY8k', 11, 'video'),
(262, 'site 2', 'https://www.lipsum.com/', 23, 'site'),
(263, 'images.png', 'befa9b851b73ae5399fd3a042f46db6c.png', 4, 'image'),
(264, 'images.png', 'd3f2460ad14dc505009114b172b69b69.png', 4, 'image'),
(265, 'images.png', '71aabeb38629bb2a051d6abc87172520.png', 4, 'image'),
(266, 'logo.jpg', 'b60fef191f7e75fa39776c81ecd38c9e.jpg', 112, 'image'),
(267, 'logo.jpg', 'fad11001185e6ab09df63f5c08891ff2.jpg', 112, 'image');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(20) NOT NULL,
  `title` varchar(250) NOT NULL,
  `resource_type` enum('video','image','site') NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `file_id_2` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `position` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `title`, `resource_type`, `file_id`, `file_id_2`, `description`, `created`, `updated`, `position`) VALUES
(19, 'Video 1', 'video', 253, 173, ' https://youtu.be/iIBDZkIOuJU    ', NULL, '2020-05-14 12:41:35', 3),
(20, 'Video 2', 'video', 254, 175, 'https://youtu.be/FyOzeO6fQwI ', NULL, '2020-05-14 12:42:05', 4),
(21, 'Video 3', 'video', 255, 177, ' https://youtu.be/hMHv5fwSY8k  ', NULL, '2020-05-14 12:42:31', 5),
(22, 'video 3', 'video', 256, 179, ' https://youtu.be/hMHv5fwSY8k   ', NULL, '2020-05-14 12:43:01', 6),
(23, 'Video 4', 'video', 257, 181, ' https://youtu.be/hMHv5fwSY8k ', NULL, '2020-05-14 12:43:36', 7),
(24, 'Video 5', 'video', 258, 183, ' https://youtu.be/hMHv5fwSY8k ', NULL, '2020-05-14 12:44:19', 8),
(25, 'Video 6', 'video', 184, 185, ' https://youtu.be/hMHv5fwSY8k', NULL, NULL, 9),
(26, 'Video 7', 'video', 259, 187, 'https://youtu.be/hMHv5fwSY8k  ', NULL, '2020-05-14 12:44:41', 10),
(27, 'Video 8', 'video', 260, 189, ' https://youtu.be/hMHv5fwSY8k ', NULL, '2020-05-14 12:45:23', 11),
(28, 'Video 9', 'video', 261, 191, 'https://youtu.be/hMHv5fwSY8k  ', NULL, '2020-05-14 12:45:53', 12),
(33, 'site 2', 'site', 262, NULL, ' https://www.lipsum.com/ ', NULL, '2020-05-14 12:46:30', 13),
(34, 'Image 1', 'image', 216, NULL, '  ', NULL, '2020-05-14 12:47:34', 14),
(35, 'Video 10', 'image', 226, 224, 'This is link video with id     ', NULL, '2020-05-17 02:52:29', 1),
(36, 'Image 2', 'image', 228, NULL, '  This is test for image', '2020-05-13 08:06:29', '2020-05-13 08:09:50', 2),
(37, 'This is video', 'video', 247, 248, ' This video for test  ', '2020-05-13 10:36:10', '2020-05-13 10:51:47', 15);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `dashboard_random` enum('1','0') NOT NULL,
  `comment_allow` enum('1','0') NOT NULL,
  `api_on` enum('1','0') NOT NULL,
  `carousel_random` enum('1','0') NOT NULL,
  `carousel_event` enum('1','0') NOT NULL,
  `carousel_limit` tinyint(4) NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `dashboard_random`, `comment_allow`, `api_on`, `carousel_random`, `carousel_event`, `carousel_limit`, `updated`) VALUES
(1, '1', '1', '1', '1', '', 20, '2020-05-16 02:35:25');

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
-- Indexes for table `analytic`
--
ALTER TABLE `analytic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classification`
--
ALTER TABLE `classification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_id` (`document_id`),
  ADD KEY `resource_id` (`resource_id`);

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
-- Indexes for table `email`
--
ALTER TABLE `email`
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
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `analytic`
--
ALTER TABLE `analytic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `classification`
--
ALTER TABLE `classification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=666;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classification`
--
ALTER TABLE `classification`
  ADD CONSTRAINT `classification_ibfk_1` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`),
  ADD CONSTRAINT `classification_ibfk_2` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`);

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
