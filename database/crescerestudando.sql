-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 19-Nov-2018 às 01:32
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crescerestudando`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `logo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `companies`
--

INSERT INTO `companies` (`id`, `name`, `logo`) VALUES
(1, 'CRESCER<br/>ESTUDANDO', 'logo.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `group_membres`
--

CREATE TABLE `group_membres` (
  `id` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupos`
--

CREATE TABLE `grupos` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `manipula_img_user`
--

CREATE TABLE `manipula_img_user` (
  `id` int(11) NOT NULL,
  `imagem` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `manipula_img_user`
--

INSERT INTO `manipula_img_user` (`id`, `imagem`) VALUES
(1, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensages`
--

CREATE TABLE `mensages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `assunto` varchar(50) NOT NULL,
  `mensagem` text NOT NULL,
  `dataenvio` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mensages`
--

INSERT INTO `mensages` (`id`, `name`, `phone`, `email`, `assunto`, `mensagem`, `dataenvio`, `status`) VALUES
(1, 'Ricardo Testando', '31987016568', 'ricardotecnicoeletronica@gmail.com', 'Testando', '		\r\nOlÃ¡ Ricardo,\r\nO Google acabou de impedir alguÃ©m de fazer login na sua Conta do Google ricardotecnicoeletronica@gmail.com em um app que pode colocar sua conta em risco.\r\n	App menos seguro\r\nquinta-feira, 23 de agosto de 2018 07:33 (HorÃ¡rio Moscou)\r\nMoscow, Russia*\r\nNÃ£o reconhece essa atividade?\r\nSe vocÃª nÃ£o recebeu um erro recentemente ao tentar acessar um serviÃ§o do Google, como o Gmail, a partir de um app de terceiros, Ã© possÃ­vel que alguÃ©m tenha sua senha.', '05/09/2018 as 04:39', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permission_groups`
--

CREATE TABLE `permission_groups` (
  `id` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `params` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `permission_groups`
--

INSERT INTO `permission_groups` (`id`, `id_company`, `name`, `params`) VALUES
(1, 1, 'Desenvolvedores', '1,2,6,9,42,43,44,73'),
(9, 1, 'TESTE', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `permission_params`
--

CREATE TABLE `permission_params` (
  `id` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `permission_params`
--

INSERT INTO `permission_params` (`id`, `id_company`, `name`) VALUES
(1, 1, 'logout'),
(2, 1, 'permissions_view'),
(6, 1, 'name_permissions'),
(9, 1, 'users_view'),
(42, 1, 'users_add_view'),
(43, 1, 'users_edit_view'),
(44, 1, 'users_dell_view'),
(73, 1, 'lista_deemails');

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `data_post` datetime NOT NULL,
  `type` varchar(100) NOT NULL,
  `textt` text NOT NULL,
  `id_group` int(11) NOT NULL,
  `pages` int(11) NOT NULL,
  `delivery_date` varchar(50) NOT NULL,
  `pay_start` float NOT NULL,
  `pay_end` float NOT NULL,
  `job` text NOT NULL,
  `concluido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `id_user`, `data_post`, `type`, `textt`, `id_group`, `pages`, `delivery_date`, `pay_start`, `pay_end`, `job`, `concluido`) VALUES
(3, 1, '2018-10-18 12:54:06', 'Trabalho de Historia', 'Lorem Ipsum Ã© simplesmente uma simulaÃ§Ã£o de texto da indÃºstria tipogrÃ¡fica e de impressos, e vem sendo utilizado desde o sÃ©culo XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos.', 0, 1, '23/10/2018', 3.7, 30, 'GilbertoGil-br.doc', 0),
(4, 1, '2018-10-28 00:10:18', 'Trabalho de Historia', 'Lorem Ipsum Ã© simplesmente uma simulaÃ§Ã£o de texto da indÃºstria tipogrÃ¡fica e de impressos, e vem sendo utilizado desde o sÃ©culo XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. ', 0, 1, '2018-11-02', 3.65, 18.65, '', 0),
(5, 9, '2018-11-18 00:13:40', 'Testando Sistema', 'nossa quero um trabalho bla bla bla ', 0, 5, '2018-11-24', 18.7, 33.7, '', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `post_comments`
--

CREATE TABLE `post_comments` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `data_create` datetime NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `post_comments`
--

INSERT INTO `post_comments` (`id`, `id_post`, `id_user`, `data_create`, `comments`) VALUES
(1, 3, 1, '2018-10-19 21:10:21', 'Lorem Ipsum e simplesmente uma simulacao de texto da industria tipografica e de impressos.'),
(2, 3, 7, '2018-10-20 22:11:21', 'Lorem Ipsum e simplesmente uma simulacao de texto da industria tipografica e de impressos.'),
(3, 3, 8, '2018-10-21 23:12:21', 'Lorem Ipsum e simplesmente uma simulacao de texto da industria tipografica e de impressos.'),
(4, 3, 1, '2018-10-22 23:55:08', 'TESTE Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(5, 3, 1, '2018-10-22 23:56:58', '2TESTE Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(6, 3, 1, '2018-10-23 00:02:31', '3TESTELorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(7, 3, 1, '2018-10-23 00:06:33', '4TESTE Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(8, 3, 1, '2018-10-23 22:30:14', 'TESTE4'),
(9, 3, 1, '2018-10-23 23:25:19', 'Teste 5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `total_amount` float NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `payment_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `purchases`
--

INSERT INTO `purchases` (`id`, `id_user`, `total_amount`, `payment_type`, `payment_status`) VALUES
(1, 9, 33.7, 'PAGSEGURO', 1),
(2, 9, 33.7, 'PAGSEGURO', 1),
(3, 9, 33.7, 'PAGSEGURO', 1),
(4, 9, 33.7, 'PAGSEGURO', 1),
(5, 9, 33.7, 'PAGSEGURO', 1),
(6, 9, 33.7, 'PAGSEGURO', 1),
(7, 9, 33.7, 'PAGSEGURO', 1),
(8, 9, 33.7, 'PAGSEGURO', 1),
(9, 9, 33.7, 'PAGSEGURO', 1),
(10, 9, 33.7, 'PAGSEGURO', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `purchases_qualpost`
--

CREATE TABLE `purchases_qualpost` (
  `id` int(11) NOT NULL,
  `id_purchase` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `post_value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `purchases_qualpost`
--

INSERT INTO `purchases_qualpost` (`id`, `id_purchase`, `id_post`, `post_value`) VALUES
(1, 1, 5, 33.7),
(2, 2, 5, 33.7),
(3, 3, 5, 33.7),
(4, 4, 5, 33.7),
(5, 5, 5, 33.7),
(6, 6, 5, 33.7),
(7, 7, 5, 33.7),
(8, 8, 5, 33.7),
(9, 9, 5, 33.7),
(10, 10, 5, 33.7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `relationship`
--

CREATE TABLE `relationship` (
  `id` int(11) NOT NULL,
  `user_de` int(11) NOT NULL,
  `user_para` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `imagem` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `bloc` int(11) NOT NULL,
  `lock_tela` int(11) NOT NULL,
  `user_lock` int(11) NOT NULL,
  `sector` varchar(100) NOT NULL,
  `id_group` int(11) NOT NULL,
  `code_pass` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `gender` int(11) NOT NULL,
  `termos` int(11) NOT NULL,
  `bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `id_company`, `imagem`, `name`, `email`, `password`, `bloc`, `lock_tela`, `user_lock`, `sector`, `id_group`, `code_pass`, `ip`, `gender`, `termos`, `bio`) VALUES
(1, 1, '495c171b5ddfa75fb22306d794a4d21c.png', 'Ricardo Alves', 'ricardotecnicoeletronica@gmail.com', 'ffe50d79a886247b7c1668f1496feb50', 0, 0, 0, 'Programador', 1, '', '::1', 1, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua'),
(7, 1, '', 'Teste', 'teste@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 0, 0, 'Teste', 1, '', '127.0.0.1', 2, 0, ''),
(8, 1, '', 'fulano', 'fulano@gmail.com', '5d254117c3875867d289e468fbb22019', 0, 0, 0, '', 0, '', '127.0.0.1', 1, 1, ''),
(9, 1, '', 'CompradorTeste', 'c36503904386523982148@sandbox.pagseguro.com.br', '74166fac37dbb94d5970dd4eefea5bef', 0, 0, 0, '', 1, '', '127.0.0.1', 1, 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_membres`
--
ALTER TABLE `group_membres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manipula_img_user`
--
ALTER TABLE `manipula_img_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mensages`
--
ALTER TABLE `mensages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_groups`
--
ALTER TABLE `permission_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_params`
--
ALTER TABLE `permission_params`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases_qualpost`
--
ALTER TABLE `purchases_qualpost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relationship`
--
ALTER TABLE `relationship`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `group_membres`
--
ALTER TABLE `group_membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manipula_img_user`
--
ALTER TABLE `manipula_img_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mensages`
--
ALTER TABLE `mensages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permission_groups`
--
ALTER TABLE `permission_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `permission_params`
--
ALTER TABLE `permission_params`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purchases_qualpost`
--
ALTER TABLE `purchases_qualpost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `relationship`
--
ALTER TABLE `relationship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
