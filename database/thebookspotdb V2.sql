-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2023 at 06:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thebookspotdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminID` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminID`, `username`, `pwd`) VALUES
(1, 'admin', '$2y$10$w1U5d0gaeytCgopjcgEtJe973iqvjjImcxpwCjqfuDBJvojDfl36O');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `format` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `publication_date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `book_ISBN` varchar(13) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `amt_sold` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `image`, `title`, `author`, `genre`, `format`, `publisher`, `publication_date`, `description`, `book_ISBN`, `language`, `price`, `stock`, `amt_sold`, `create_at`) VALUES
(1, 'https://cdn.shopify.com/s/files/1/0511/7575/1837/products/63975913z_276x.jpg?v=1660118189', 'The Ballad of Never After', 'Stephanie Garber', 'Young Adult Fantasy', 'Paperback', 'Platiron', '2022-09-13', 'Not every love is meant to be.\n\nAfter Jacks, the Prince of Hearts, betrays her, Evangeline Fox swears she\'ll never trust him again. Now that she’s discovered her own magic, Evangeline believes she can use it to restore the chance at happily ever after that Jacks stole away.\n\nBut when a new terrifying curse is revealed, Evangeline finds herself entering into a tenuous partnership with the Prince of Hearts again. Only this time, the rules have changed. Jacks isn’t the only force Evangeline needs to be wary of. In fact, he might be the only one she can trust, despite her desire to despise him.\n\nInstead of a love spell wreaking havoc on Evangeline’s life, a murderous spell has been cast. To break it, Evangeline and Jacks will have to do battle with old friends, new foes, and a magic that plays with heads and hearts. Evangeline has always trusted her heart, but this time she’s not sure she can...', '9781250879530', 'English', 44.93, 15, 0, '2023-09-18 14:32:35'),
(2, 'https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9781803362182_262x.jpg?v=1663638420', 'A Magic Steeped In Poison', 'Judy I. Lin', 'Young Adult Fantasy', 'Paperback', 'Titan', '2022-03-29', 'I used to look at my hands with pride. Now all I can think is, These are the hands that buried my mother.\n\nFor Ning, the only thing worse than losing her mother is knowing that it\'s her own fault. She was the one who unknowingly brewed the poison tea that killed her the poison tea that now threatens to also take her sister, Shu.\n\nWhen Ning hears of a competition to find the kingdom\'s greatest shennong-shi--masters of the ancient and magical art of tea-making--she travels to the imperial city to compete. The winner will receive a favor from the princess, which may be Ning\'s only chance to save her sister\'s life.\n\nBut between the backstabbing competitors, bloody court politics, and a mysterious (and handsome) boy with a shocking secret, Ning might actually be the one in more danger.', '9781803362182', 'English', 47.92, 13, 2, '2023-09-18 14:51:20'),
(3, 'https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9781534465299_267x.jpg?v=1657787764', 'Blood Like Magic', 'Liselle Sambury', 'Young Adult Fantasy', 'Paperback', 'Simon & Schuster US', '2021-06-15', 'An urban fantasy debut following a teen witch who is given a horrifying task: sacrificing her first love to save her family’s magic. The problem is, she’s never been in love—she’ll have to find the perfect guy before she can kill him.\n\nAfter years of waiting for her Calling—a trial every witch must pass in order to come into their powers—the one thing Voya Thomas didn’t expect was to fail. When Voya’s ancestor gives her an unprecedented second chance to complete her Calling, she agrees—and then is horrified when her task is to kill her first love. And this time, failure means every Thomas witch will be stripped of their magic.\n\nVoya is determined to save her family’s magic no matter the cost. The problem is, Voya has never been in love, so for her to succeed, she’ll first have to find the perfect guy—and fast. Fortunately, a genetic matchmaking program has just hit the market. Her plan is to join the program, fall in love, and complete her task before the deadline. What she doesn’t count on is being paired with the infuriating Luc—how can she fall in love with a guy who seemingly wants nothing to do with her?\n\nWith mounting pressure from her family, Voya is caught between her morality and her duty to her bloodline. If she wants to save their heritage and Luc, she’ll have to find something her ancestor wants more than blood. And in witchcraft, blood is everything.', '9781534465299', 'English', 55.12, 20, 0, '2023-09-18 15:00:11'),
(4, 'https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9781471410918_260x.jpg?v=1657787594', 'Daughter of Darkness', 'Katharine Corr', 'Young Adult Fantasy', 'Paperback', 'Hot Key Books', '2022-10-04', 'Deina is trapped. As one of the Soul Severers serving the god Hades on earth, her future is tied to the task of shepherding the dying on from the mortal world - unless she can earn or steal enough to buy her way out.\n\nThen the tyrant ruler Orpheus offers both fortune and freedom to whoever can retrieve his dead wife, Eurydice, from the Underworld. Deina jumps at the chance. But to win, she must enter an uneasy alliance with a group of fellow Severers she neither likes nor trusts.\n\nSo begins their perilous journey into the realm of Hades... The prize of freedom is before her - but what will it take to reach it?\n\nEnter the Underworld in an epic new fantasy, where the Gods of ancient Greece rule everything but fate.', '9781471410918', 'English', 45.20, 20, 0, '2023-09-18 15:05:11'),
(5, 'https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9780241532577_261x.jpg?v=1657787945', 'Beasts of Ruin', 'Ayana Gray', 'Young Adult Fantasy', 'Paperback', 'Puffin UK', '2022-07-26', 'In this much anticipated follow up to New York Times bestselling Beasts of Prey, Koffi’s powers grow stronger and Ekon’s secrets turn darker as they face the god of death.\n\nKoffi has saved her city and the boy she loves, but at a terrible price. Now a servant to the cunning god of death, she must use her newfound power to further his continental conquest, or risk the safety of her home and loved ones. As she reluctantly learns to survive amidst unexpected friends and foes, she will also have to choose between the life—and love—she once had, or the one she could have, if she truly embraces her dangerous gifts.\n\nCast out from the only home he’s ever known, Ekon is forced to strike new and unconventional alliances to find and rescue Koffi before it’s too late. But as he gets closer to the realm of death each day, so too does he draw nearer to a terrible truth—one that could cost everything.\n\nKoffi and Ekon—separated by land, sea, and gods—will have to risk everything to reunite again. But the longer they’re kept apart, the more each of their loyalties are tested. Soon, both may have to reckon with changing hearts—and maybe, changing destinies.', '9780241532577', 'English', 48.35, 16, 0, '2023-09-18 15:06:01'),
(6, 'https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9780702314636_500x.jpg?v=1642663434', 'The Girl with No Soul', 'Morgan Owen', 'Young Adult Fantasy', 'Paperback', 'Scholastic UK', '2022-01-09', 'How can you find your soul mate, when you don\'t have a soul?\n\nIris lives in a world ruled by The Order. Inspectors police the population by keeping careful watch over people\'s souls. If they shine their lanterns on you, your soul is projected for the world to see... and judge. But Iris has a deadly secret ... she is a hollow, a person with no soul.\n\nShe must hide from the Order at all costs, scraping a living in the shadows. But when she\'s sent to steal a ring from a lady of nobility, she is reunited with her Spark - one of the five parts that make up her own missing soul.\n\nNow she must rely on the help of a young scholar named Evander Mountebank to track down the other four missing pieces of her soul, all the while evading The Order. Will she be able to protect her heart as well as find her soul?\n\nThe Girl with no Soul combines a fabulous concept, a swooning love story, and intoxicating world building in one glorious package. Perfect for fans of Alice Broadway and Leigh Bardugo. Morgan Owen is a bright new talent in the YA world.', '9780702314636', 'English', 48.90, 25, 0, '2023-09-18 15:09:47'),
(7, 'https://mphonline.com/cdn/shop/files/41SRgHgKy5L._SX321_BO1_204_203_200.jpg?v=1692753494&width=240', 'These Infinite Threads', 'Tahereh Mafi', 'Young Adult Fantasy', 'Paperback', 'Farshore', '2023-02-02', 'Full of explosive magic, searing romance, and heartbreaking betrayal, These Infinite Threads is the breathtaking sequel to the instant New York Times and Sunday Times bestseller This Woven Kingdom\r\n\r\nWith the heat of a kiss, the walls between Alizeh, the long-lost heir to an ancient Jinn kingdom, and Kamran, the crown prince of the Ardunian empire, have crumbled. And so have both of their lives.\r\n\r\nKamran\'s grandfather, the king of Ardunia, lays dead, the terrible secret of his deal with the devil exposed to the world. Cyrus, the mysterious copper-haired royal, has stolen Alizeh away to Tulan, the neighboring kingdom where he rules. Cyrus has made his own deal with the devil-one that would require Alizeh to betray her feelings for Kamran if she\'s to reclaim the Jinn throne.\r\n\r\nAlizeh wants nothing to do with Cyrus, or his deal with Iblees. But with no means of escaping Tulan, and with the tantalizing promise of fulfilling her destiny as the heir to the Jinn, she\'s forced to wonder whether she can set aside her emotions-and finally become the queen her people need.\r\n\r\nKamran, meanwhile, is picking up the pieces of his broken kingdom. Facing betrayal at every turn, all he knows for certain is that he must go to Tulan to avenge his grandfather. He can only hope that Alizeh will be waiting for him there-and that she\'s not yet become queen of Tulan.', '9780008592233', 'English', 74.90, 25, 2, '2023-10-08 00:06:07'),
(8, 'https://mphonline.com/cdn/shop/files/9780062085542.jpg?v=1695706621&width=840', 'Shatter Me #2: Unravel Me (US)', 'Tahereh Mafi', 'Young Adult Fantasy', 'Paperback', 'HARPER COLLINS PUB. UK', '2013-12-31', 'It should have taken Juliette a single touch to kill Warner. But his mysterious immunity to her deadly power has left her shaken, wondering why her ultimate defense mechanism failed against the person she most needs protection from.\r\n\r\nShe and Adam were able to escape Warner’s clutches and join up with a group of rebels, many of whom have powers of their own. Juliette will finally be able to actively fight against The Reestablishment and try to fix her broken world. And perhaps these new allies can help her shed light on the secret behind Adam’s—and Warner’s—immunity to her killer skin.\r\n\r\nJuliette’s world is packed with high-stakes action and tantalizing romance, perfect for fans of the Red Queen series by Victoria Aveyard and the Darkest Minds trilogy by Alexandra Bracken.\r\n\r\nRansom Riggs, #1 New York Times bestselling author of Miss Peregrine\'s Home for Peculiar Children, raved: \"A thrilling, high-stakes saga of self-discovery and forbidden love, the Shatter Me series is a must-read for fans of dystopian young-adult literature—or any literature!\"\r\n\r\nAnd don’t miss Defy Me, the shocking fifth book in the Shatter Me series!', '9780062085542', 'English', 59.90, 20, 15, '2023-10-08 00:08:01'),
(9, 'https://mphonline.com/cdn/shop/files/Jacket_cf72cde0-c824-4ddf-94eb-a5f1e00425fa.jpg?v=1692602610&width=360', 'The Iron Sword', 'Julie Kagawa', 'Young Adult Fantasy', 'Paperback', 'Inkyard Press', '2012-03-14', 'As Evenfall nears, the stakes grow ever higher for those in Faery…\r\n\r\nBanished from the Winter Court for daring to fall in love, Prince Ash achieved the impossible and journeyed to the End of the World to earn a soul and keep his vow to always stand beside Queen Meghan of the Iron Fey.\r\n\r\nNow he faces even more incomprehensible odds. Their son, King Keirran of the Forgotten, is missing. Something more ancient than the courts of Faery and more evil than anything Ash has faced in a millennium is rising as Evenfall approaches. And if Ash and his allies cannot stop it, the chaos that has begun to divide the world will shatter it for eternity.', '9781335429162', NULL, 79.95, 35, 0, '2023-10-08 00:10:33'),
(10, 'https://mphonline.com/cdn/shop/files/x293_cb80e85f-bd17-4467-898e-56f421f0b6fb.jpg?v=1695719289&width=240', 'Upon a Frosted Star', 'M.A. KUZNIAR', 'Young Adult Fantasy', 'Paperback', 'HQ', '2023-09-21', 'When the snow falls, she will be free…\r\nThe invitations always arrive the same way – without warning, appearing around the city on the first snowfall of the year, simply inscribed with ‘Tonight.’\r\n\r\nWhen struggling artist, Forster, finds an invitation, he’s bewitched by the magic of the evening, swept up in the glamour of this notorious annual party and intrigued as to who is behind them.\r\n\r\nDetermined to find out more about the mysterious host, Forster discovers an abandoned manor house silent with secrets and a cursed woman who is desparate to be free…\r\n\r\nFrom the bestselling author of Midnight in Everwood, comes another spellbinding literary fairy tale that’s The Great Gatsby meets Swan Lake.', '9780008450724', 'English', 94.50, 33, 1, '2023-10-08 00:12:55'),
(11, 'https://mphonline.com/cdn/shop/files/81Rd6Uvg7KL._SY466.jpg?v=1695707120&width=240', 'Enchanted to Meet You', 'Meg Cabot', 'Romance', 'Paperback', 'Avon', '2023-09-05', 'A witchy rom-com from New York Times bestseller Meg Cabot about a plus size witch who must team up with a handsome stranger to help protect her village from an otherworldly force—but will she be able to protect her heart?\r\n\r\nIt’s Magic When You Meet Your Match\r\n\r\nIn her teenage years, lovelorn Jessica Gold cast a spell that went disastrously wrong, and brought her all the wrong kind of attention—as well as a lifetime ban from the World Council of Witches.\r\n\r\nSo no one is more surprised than Jess when, fifteen years later, tall, handsome WCW member Derrick Winters shows up in her quaint little village of West Harbor and claims that Jess is the Chosen One.\r\n\r\nShe’s the Chosen One\r\n\r\nNot chosen by West Harbor’s snobby elite to style them for the town’s tricentennial ball—though Jess owns the chicest clothing boutique in town. And not chosen finally to be on the WCW, either—not that Jess would have said yes, anyway, since she’s done with any organization that tries to dictate what makes a “true” witch.\r\n\r\nNo, Jess has been chosen to help save West Harbor itself . . .\r\n\r\nAs Summer Ends, Her Power Grows\r\n\r\nBut just when Jess is beginning to think that she and Derrick might have a certain magic of their own—and not of the supernatural variety—Jess learns he may not be who she thought he was. \r\n\r\nAnd suddenly Jess finds herself having to make another kind of choice: trust Derrick and work with him to combat the sinister force battling to bring down West Harbor, or use her gift as she always has: to keep herself, and her heart, safe.\r\n\r\nCan she work her magic in time?', '9780063268371', 'English', 62.95, 27, 3, '2023-10-08 00:14:34'),
(12, 'https://mphonline.com/cdn/shop/files/9780593548578.jpg?v=1695774140&width=240', 'Witch of Wild Things', 'Raquel Vasquez Gilliland', 'Romance', 'Paperback', 'Berkley', '2023-09-12', 'One of Amazon’s Best Romances of September!\r\n\r\nLegend goes that long ago a Flores woman offended the old gods, and their family was cursed as a result. Now, every woman born to the family has a touch of magic.\r\n \r\nSage Flores has been running from her family—and their “gifts”—ever since her younger sister Sky died. Eight years later, Sage reluctantly returns to her hometown. Like slipping into an old, comforting sweater, Sage takes back her job at Cranberry Rose Company and uses her ability to communicate with plants to discover unusual heritage specimens in the surrounding lands.\r\n\r\nWhat should be a simple task is complicated by her partner in botany sleuthing: Tennessee Reyes. He broke her heart in high school, and she never fully recovered. Working together is reminding her of all their past tender, genuine moments—and new feelings for this mature sexy man are starting to take root in her heart.\r\n\r\nWith rare plants to find, a dead sister who keeps bringing her coffee, and another sister whose anger fills the sky with lightning, Sage doesn’t have time for romance. But being with Tenn is like standing in the middle of a field on the cusp of a summer thunderstorm—supercharged and inevitable.', '9780593548578', 'English', 84.95, 10, 6, '2023-10-08 00:19:40'),
(13, 'https://mphonline.com/cdn/shop/files/81W1rRX8LgL._SY466.jpg?v=1695707588&width=240', 'See You on Venus (US)', 'Victoria Vinuesa', 'Romance', 'Paperback', 'Delacorte Press', '2023-09-05', 'Fall in love with this runaway romance now a major motion picture! Two star-crossed teens embark on a journey to Spain to discover the meaning of love, death and everything in between. \r\n\r\nMia has had a heart condition her whole life. She\'s not afraid of dying but something has always stopped her from her biggest fear: tracking down her biological mother in Spain...until now. Before her next surgery, Mia wants to meet the woman who gave her away once and for all. \r\n\r\nKyle has always been the life of the party...that was until the car accident that killed his best friend. Since then he\'s been reeling with guilt and willing to do just about anything to escape his reality.  \r\n\r\nAfter a twist of fate, Mia and Kyle meet and make the decision to travel to Spain together in search of answers they both desperately need to mend their broken hearts...but did the universe bind them together to change how they feel about death and love forever?\r\n\r\n\r\nSee You on Venus is a heartwrenching novel perfect for readers looking for:\r\nContemporary teen romance books \r\nComplex emotional YA stories\r\nBooks to finish before or after seeing the film\r\nTikTok favorites like If He Had Been With Me, Girl in Pieces, You\'ve Reached Sam and Five Feet Apart\r\nColleen Hoover books', '9780593705131', 'English', 64.95, 13, 3, '2023-10-08 00:24:59'),
(14, 'https://mphonline.com/cdn/shop/files/9781405963206-jacket-large.jpg?v=1695707504&width=240', 'Paper Princess (The Royals #1) UK', 'Erin Watt', 'Romance', 'Paperback', 'Penguin UK', '2023-09-19', 'Be careful what you wish for . . .\r\n\r\nElla Harper is a survivor. She\'s spent her whole life poor, her mother struggling to make ends meet - yet still believing that someday she\'d climb out of the gutter. But after her mother\'s death, Ella is truly lost and alone.\r\n\r\nUntil Callum Royal appears, picking Ella up and dropping her into his mansion - among his five sons, who all hate her. Each Royal boy is more magnetic than the last. But none is as captivating as Reed Royal, the boy most determined to send her back to the slums.\r\n\r\nReed doesn\'t want her. He says she doesn\'t belong with the Royals.\r\n\r\nHe might be right.\r\n\r\nWealth. Excess. Deception. It\'s nothing Ella has ever experienced.\r\n\r\nBut if she\'s going to survive in the Royal palace, she\'ll need to start issuing her own Royal decrees . . .', '9781405963206', 'English', 64.95, 10, 0, '2023-10-08 00:26:25'),
(15, 'https://mphonline.com/cdn/shop/files/x400_f191c2d3-35bf-42be-8f09-3a4d21348d60.jpg?v=1695709650&width=360', 'If I Have to Be Haunted (UK)', 'Miranda Sun', 'Romance', 'Paperback', 'Magpie (HCUK)', '2023-09-14', 'Cemetery Boys meets Legendborn in this thrillingly romantic, irresistibly fun YA contemporary fantasy debut following a teenage Chinese American ghost speaker who (reluctantly) makes a deal to raise her nemesis from the dead.\r\n\r\nCara Tang doesn’t want to be haunted.\r\n\r\nLook, the dead have issues, and Cara has enough of her own. Her overbearing mother insists she be the “perfect” Chinese American daughter—which means suppressing her ghost-speaking powers—and she keeps getting into fights with Zacharias Coleson, the local golden boy whose smirk makes her want to set things on fire.\r\n\r\nThen she stumbles across Zach’s dead body in the woods. He’s even more infuriating as a ghost, but Cara’s the only one who can see him—and save him.\r\n\r\nAgreeing to resurrect him puts her at odds with her mother, draws her into a dangerous liminal world of monsters and magic—and worse, leaves her stuck with Zach. Yet as she and Zach grow closer, forced to depend on each other to survive, Cara finds the most terrifying thing is that she might not hate him so much after all.\r\n\r\nMaybe this is why her mother warned her about ghosts.\r\n\r\nDelightful and compulsively readable, this contemporary fantasy has something for every reader: a snarky voice, a magnetic enemies-to-lovers romance, and a spirited adventure through a magical, unpredictable world hidden within our own.', '9780008612412', 'English', 89.95, 25, 0, '2023-10-08 00:27:40'),
(16, 'https://mphonline.com/cdn/shop/files/MOL_237ab5ab-aa88-43ca-8c04-3bc017e20ffd.jpg?v=1694061785&width=840', 'Things We Left Behind', 'Lucy Score', 'Romance', 'Paperback', 'Hodder Books', '2023-09-05', 'There was only one woman who could set me free. But I would rather set myself on fire than ask Sloane Walton for anything.\r\n\r\nLucian Rollins is a lean, mean vengeance-seeking mogul. On a quest to erase his father\'s mark on the family name, he spends every waking minute pulling strings and building an indestructible empire. The more money and power he amasses, the safer he is from threats.\r\n\r\nExcept when it comes to the feisty small-town librarian that keeps him up at night . . .\r\n\r\nSloane Walton is a spitfire determined to carry on her father\'s quest for justice. She\'ll do that just as soon as she figures out exactly what the man she hates did to - or for - her family. Bonded by an old, dark secret from the past and the dislike they now share for each other, Sloane trusts Lucian about as far as she can throw his designer-suited body.\r\n\r\nWhen bickering accidentally turns to foreplay, these two find themselves not quite regretting their steamy one-night stand. Once those flames are fanned, it seems impossible to put them out again. But with Sloane ready to start a family and Lucian refusing to even consider the idea of marriage and kids, these enemies-to-lovers are stuck at an impasse.\r\n\r\nBroken men break women. It\'s what Lucian believes, what he\'s witnessed, and he\'s not going to take that chance with Sloane. He\'d rather live a life of solitude than put her in danger. But he learns the hard way that leaving her means leaving her unprotected from other threats.\r\n\r\nIt\'s the second time he\'s ruthlessly cut her out of his life. There\'s no way she\'s going to give him a third chance. He\'s just going to have to make one for himself.', '9781399713795', 'English', 62.90, 15, 3, '2023-10-08 00:28:59'),
(17, 'https://mphonline.com/cdn/shop/files/41gnHNZaRrL._SY291_BO1_204_203_200_QL40_ML2.jpg?v=1692927310&width=480', 'The Neighbor Favor', 'Kristina Forest', 'Romance', 'Paperback', '\r\nMichael Joseph', '2023-06-06', 'In this heart-fluttering romance a shy bookworm falls for her mysterious and charming neighbour, not realising there\'s history already there . . .\r\n\r\nShy, bookish, Lily Greene finds escapism in her correspondences with her favourite fantasy author - until he ghosts her. Months later, Lily seeks a date to her sister\'s wedding. And the perfect person to help her is Nick Brown, her charming, attractive new neighbour. Little does she know that Nick is an author--her favourite fantasy author. Nick soon realises that the beautiful woman from down the hall is the same Lily he fell in love with over e-mail months ago. Unwilling to complicate things even more, he agrees to set her up with someone else - but, he can\'t get her off his mind.', '9781405956451', 'English', 62.95, 25, 2, '2023-10-08 00:30:12'),
(18, 'https://mphonline.com/cdn/shop/files/41qWoccfzoL._SY291_BO1_204_203_200_QL40_FMwebp.webp?v=1692927155&width=480', 'The Nanny', 'Lana Ferguson', 'Romance', 'Paperback', 'Berkley', '2023-04-11', 'A woman discovers the father of the child she is nannying may be her biggest (Only)Fan in this steamy contemporary romance by Lana Ferguson.\r\n \r\nSuddenly unemployed and on the brink of eviction, Cassie Evans is left with two choices: get a new job (and fast) or fire up her long-untouched OnlyFans account. But the job market is terrible, and as for OnlyFans. . . . Well, there are reasons she can’t go back. Just when all hope seems lost, an ad for a live-in nanny position seems like the solution to all her problems. It’s almost too perfect—until she meets her would-be employer.\r\n \r\nAiden Reid, executive chef and DILF extraordinaire, is far from the stuffy single dad Cassie was imagining. He shocks her when he tells her she’s the most qualified applicant he’s met in weeks, practically begging her to take the job. With hands that make her hindbrain howl and eyes that scream sex, the idea of living under the same roof as Aiden feels dangerous, but with no other option, she decides to stay with him and his adorably tenacious daughter, Sophie.\r\n \r\nCassie soon discovers that Aiden is not a stranger at all, but instead someone who is very familiar with her—or at least, her body. Given that he doesn’t remember her, Cassie is faced with what feels like an impossible situation. As their relationship heats to temperatures hotter than any kitchen Aiden has ever worked in, Cassie struggles with telling Aiden the truth, and the more terrifying possibility—losing the best chance at happiness she’s ever had.', '9780593549353', 'English', 79.95, 20, 0, '2023-10-08 00:31:33'),
(19, 'https://mphonline.com/cdn/shop/files/148899.jpg?v=1692931044&width=420', 'The View From Coral Cove', 'Amy Clipston', 'Romance', 'Paperback', 'Thomas Nelson', '2023-06-22', 'When a jilted romance novelist escapes to a small beach town, the last thing she expected to find was the start of an even better love story.\r\n\r\nIn the wake of a broken engagement and the death of her last surviving family member, sweet romance novelist Maya Reynolds moves to the haven of Coral Cove, North Carolina, to take over her great-aunt\'s toy store. Some of her grief is immediately eased by imaginative eight-year-old Ashlyn Tanner, who talks her into adopting a kitten and inspires Maya to create a princess tea-party room in the store.\r\n\r\nAshlyn\'s dad, local veterinarian Brody Tanner, is quickly smitten by the newest resident of his hometown. As a single parent, he sacrifices a lot in order to give Ashlyn the world, so a romantic entanglement with Maya is not a distraction he is looking for.\r\n\r\nAs the three develop a deepening bond in the seaside town where Maya experienced some of her happiest childhood memories, clouds cast a shadow over Maya\'s hope for the future: an impossible deadline looms over her next novel, a long-held secret by her late mother about Maya\'s absent father comes to light, and Brody\'s resolve to avoid romance seems unbreakable.\r\n\r\nBut together, they just might discover that sometimes happy endings happen outside the pages of Maya\'s novels too.\r\n\r\nAdvance praise for The View from Coral Cove:\r\n\r\n\"Grieving and brokenhearted, novelist Maya Reynolds moves to Coral Cove, the place where she felt happiest as a child. An old family secret upends Maya\'s plan for a fresh start, as does her longing to love and be loved. The View from Coral Cove is Amy Clipston at her best--a tender story of hope, healing, and a love that\'s meant to be.\" --Suzanne Woods Fisher, bestselling author of On a Summer Tide\r\n\r\n\"Amy Clipston writes a sweet and tender romance filled with a beautiful look at how love brings healing to broken hearts. This small-town romance, with an adorable little girl and cat to boot, is a great addition to your TBR list.\" --Pepper Basham, author of The Mistletoe Countess and the Mitchell\'s Crossroads series', '9780840712295', 'English', 46.95, 10, 2, '2023-10-08 00:32:47'),
(20, 'https://mphonline.com/cdn/shop/files/51e9QhVL9sL._SX316_BO1_204_203_200.jpg?v=1692610009&width=240', 'Meet Me At The Lake', 'Carley Fortune', 'Romance', 'Paperback', 'Piatkus', '2023-03-09', 'A random connection sends two strangers on a daylong adventure where they make a promise one keeps and the other breaks, with life-changing effects, in this breathtaking new novel from the New York Times bestselling author of Every Summer After.\r\n\r\nFern Brookbanks has wasted far too much of her adult life thinking about Will Baxter. She spent just twenty-four hours in her early twenties with the aggravatingly attractive, idealistic artist, a chance encounter that spiraled into a daylong adventure in the city. The timing was wrong, but their connection was undeniable: they shared every secret, every dream, and made a pact to meet one year later. Fern showed up. Will didn\'t.\r\n\r\nAt thirty-two, Fern\'s life doesn\'t look at all how she once imagined it would. Instead of living in the city, Fern\'s back home, running her mother\'s lakeside resort-something she vowed never to do. The place is in disarray, her ex-boyfriend\'s the manager, and Fern doesn\'t know where to begin.\r\n\r\nShe needs a plan-a lifeline. To her surprise, it comes in the form of Will, who arrives nine years too late, with a suitcase in tow and an offer to help on his lips. Will may be the only person who understands what Fern\'s going through. But how could she possibly trust this expensive-suit wearing mirage who seems nothing like the young man she met all those years ago. Will is hiding something, and Fern\'s not sure she wants to know what it is.\r\n\r\nBut ten years ago, Will Baxter rescued Fern. Can she do the same for him?', '9780349433110', 'English', 59.90, 25, 0, '2023-10-08 00:34:10'),
(21, 'https://mphonline.com/cdn/shop/files/41uIFm0hU3L._SY291_BO1_204_203_200_QL40_FMwebp.webp?v=1692602211&width=480', 'In Case You Missed It', 'Lindsey Kelk', 'Romance', 'Paperback', 'HarperCollins', '2020-07-23', 'Hilarious, relatable and heartwarming: the brand new romantic comedy from Lindsey Kelk.\r\n\r\nWhen Ros steps off a plane after four years away she’s in need of a job, a flat and a phone that actually works. And, possibly, her old life back. Because everyone at home has moved on, her parents have reignited their sex life, she’s sleeping in a converted shed and she’s got a bad case of nostalgia for the way things were.\r\n\r\nThen her new phone begins to ping with messages from people she thought were deleted for good. Including one number she knows off by heart: her ex’s.\r\n\r\nSometimes we’d all like the chance to see what we’ve been missing…', '9780008236892', 'English', 49.95, 20, 1, '2023-10-08 00:35:34'),
(22, 'https://mphonline.com/cdn/shop/files/41UlQ_TY3WL._SY344_BO1_204_203_200.jpg?v=1692343427&width=480', 'Bright', 'Jessica Jung', 'Romance', 'Paperback', '\r\nSimon & Schuster Us', '2023-05-02', 'The “glitzy sequel filled with drama and self-discovery” (Kirkus Reviews) to the instant New York Times bestseller Shine! Crazy Rich Asians meets Gossip Girl in this knockout series from Jessica Jung, K-pop legend, fashion icon, and founder of the international luxury brand, Blanc & Eclare.\r\n\r\nCouture gowns, press parties, international travel. Rachel Kim is at the top of her game. Girls Forever is now the number-one K-pop group in the world, and her fame skyrockets after her viral airport styling attracts the attention of fashion’s biggest names. Her life’s a swirl of technicolor glamour and adoring fans. Rachel can’t imagine shining any brighter.\r\n\r\nThe only thing that’s missing is love—but Rachel’s determined to follow the rules. In her world, falling in love can cost you everything.\r\n\r\nEnter Alex. When Rachel literally falls head over designer heels into his lap on a crowded metro, she’s tempted to give up her anti-love vows. Alex is more than just heart-stopping dimples and adorably quirky banter. He believes in Rachel’s future—both in music and in fashion.\r\n\r\nBut the higher you rise, the farther you have to fall. And when a shocking act of betrayal shatters her world, Rachel must finally listen to her heart.', '9781534462557', 'English', 65.90, 10, 0, '2023-10-08 00:36:51'),
(23, 'https://mphonline.com/cdn/shop/files/41upuQ-LM-L._SX328_BO1_204_203_200.jpg?v=1692340440&width=240', 'Begin Again', 'Emma Lord', 'Romance', 'Paperback', 'Macmillan', '2023-01-31', 'Filled with a friend group that feels like family, an empowering journey of finding your own way, and a Just Kiss Already! romance, Begin Again is an unforgettable novel of love and starting again.\r\n\r\nAs usual, Andie Rose has a plan: transfer from community college to the hyper competitive Blue Ridge State, major in psychology, and maintain her lifelong goal of becoming an iconic self-help figure despite the nerves that have recently thrown her for a loop. All it will take is ruthless organization, hard work, and her trademark unrelenting enthusiasm to pull it all together.\r\n\r\nBut the moment Andie arrives, the rest of her plans go off the rails. Her rocky relationship with her boyfriend Connor only gets more complicated when she discovers he transferred out of Blue Ridge to her community college. Her roommate Shay needs to chose a major, and despite Andie\'s impressive track record of being The Fixer, she\'s stumped on how to help. And Milo, her coffee-guzzling grump of a resident assistant with seafoam green eyes, is somehow disrupting all her ideas about love and relationships one sleep-deprived wisecrack at a time. But sometimes, when all your plans are in rubble at your feet, you find out what you\'re made of. And when Andie starts to find the power of her voice as the anonymous Squire on the school\'s legendary pirate radio station ?-? the same one her mom founded, years before she passed away-Andie learns that not all the best laid plans are necessarily the right ones.\r\n\r\nAbout the Author\r\n\r\nEmma Lord is a digital media editor and writer living in New York City, where she spends whatever time she isn\'t writing either running or belting show tunes in community theater. She graduated from the University of Virginia with a major in psychology and a minor in how to tilt your computer screen so nobody will notice you updating your fan fiction from the back row. She was raised on glitter, a whole lot of love, and copious amounts of grilled cheese.', '9781035011728', 'English', 59.90, 25, 7, '2023-10-08 00:38:19'),
(24, 'https://mphonline.com/cdn/shop/files/Jacket_11022531-5c9d-4e31-a729-760b64f41c60.jpg?v=1692357093&width=480', 'Dreamland', 'Nicholas Sparks', 'Romance', 'Paperback', 'Dell', '2023-08-03', 'After fleeing an abusive husband with her six-year-old son, Tommie, Beverly is attempting to create a new life for them in a small town off the beaten track. Despite their newfound freedom, Beverly is constantly on guard: she creates a fake backstory, wears a disguise around town, and buries herself in DIY projects to stave off anxiety. But her stress only rises when Tommie insists he\'d been hearing someone walking on the roof and calling his name late at night. With money running out and danger seemingly around every corner, she makes a desperate decision that will rewrite everything she knows to be true. . . .\r\n\r\nMeanwhile, Colby Mills is on a heart-pounding journey of another kind. A failed musician, he now heads a small family farm in North Carolina. Seeking a rare break from his duties at home, he spontaneously takes a gig playing in a bar in St. Pete Beach, Florida, where he meets Morgan Lee--and his whole life is turned upside-down.\r\n\r\nThe daughter of affluent Chicago doctors, Morgan has graduated from a prestigious college music program with the ambition to move to Nashville and become a star. Romantically and musically, she and Colby complete each other in a way that neither has ever known.\r\n\r\nIn the course of a single unforgettable week, two young people will navigate the exhilarating heights and heartbreak of first love. Hundreds of miles away, Beverly will put her love for her young son to the test. And fate will draw all three people together in a web of life-altering connections . . . forcing each to wonder whether the dream of a better life can ever survive the weight of the past.', '9780593724118', 'English', 49.95, 25, 3, '2023-10-08 00:40:07'),
(25, 'https://mphonline.com/cdn/shop/files/Jacket_af5f743c-fe5e-4d4e-a111-0908d1c3dde1.jpg?v=1692357094&width=240', 'Long Shot (Hoops #1)', 'Kennedy Ryan', 'Romance', 'Paperback', 'Bloom Books', '2022-11-16', 'A FORBIDDEN LOVE SET IN THE EXPLOSIVE WORLD OF THE NBA . . .\r\n\r\nThink you know what it\'s like being a baller\'s girl?\r\n\r\nYou don\'t.\r\n\r\nMy fairy tale is upside down.\r\n\r\nA happily never after.\r\n\r\nI kissed the prince and he turned into a fraud.\r\n\r\nI was a fool, and his love - fool\'s gold.\r\n\r\nNow there\'s a new player in the game, August West.\r\n\r\nOne of the NBA\'s brightest stars.\r\n\r\nFine. Forbidden.\r\n\r\nHe wants me. I want him.\r\n\r\nBut my past, my fraudulent prince, just won\'t let me go ', '9781728284965', 'English', 84.95, 10, 0, '2023-10-08 00:42:59'),
(26, 'https://mphonline.com/cdn/shop/files/41EZLKYv1RL._SY291_BO1_204_203_200_QL40_FMwebp.webp?v=1687744520&width=480', 'The Blighted Stars (Volume 1) (The Devoured Worlds, 1)', 'Megan E. O\'Keefe', 'Science Fiction', 'Paperback', 'Orbit', '2023-05-23', 'Stranded on a dead planet with her mortal enemy, a spy must survive and uncover a conspiracy in the first book of an epic space opera trilogy by an award‑winning author.\r\n\r\nShe\'s a revolutionary. Humanity is running out of options. Habitable planets are being destroyed as quickly as they\'re found and Naira Sharp thinks she knows the reason why. The all-powerful Mercator family has been controlling the exploration of the universe for decades, and exploiting any materials they find along the way under the guise of helping humanity\'s expansion. But Naira knows the truth, and she plans to bring the whole family down from the inside.\r\n\r\nHe\'s the heir to the dynasty. Tarquin Mercator never wanted to run a galaxy-spanning business empire. He just wanted to study rocks and read books. But Tarquin\'s father has tasked him with monitoring the settlement of a new planet, and he doesn\'t really have a choice in the matter.\r\n\r\nDisguised as Tarquin\'s new bodyguard, Naira plans to destroy the settlement ship before they make land. But neither of them expects to end up stranded on a dead planet. To survive and keep her secret, Naira will have to join forces with the man she\'s sworn to hate. And together they will uncover a plot that\'s bigger than both of them.', '9780316290791', 'English', 94.95, 23, 1, '2023-10-09 20:09:38'),
(27, 'https://mphonline.com/cdn/shop/files/51b5SqcRvwL._SY291_BO1_204_203_200_QL40_FMwebp.webp?v=1686621344&width=480', 'What Happens After Midnight', 'K. L. Walther', 'Science Fiction', 'Paperback', 'Sourcebooks Fire', '2023-06-27', 'From the bestselling author of The Summer of Broken Rules comes a new coming-of-age romance about senior year, first love, and finding yourself.\r\n\r\nLily Hopper has two more weeks until she\'s officially finished with boarding school. With graduation quickly approaching Lily is worried that she\'s somehow missed out on the fun of being in high school. So, when she receives a mysterious note inviting her to join the anonymous senior class Jester in executing the end-of-year prank, Lily sees her chance to put her goody-two-shoes reputation behind her.\r\n\r\nWhen Lily realizes the Jester is none other than Taggart Swell, her ex- boyfriend, she\'s already in too deep to back out. Lily might\'ve dumped Tag, but she still has major feelings. Plus, his brilliant plan to steal the school\'s yearbooks, targets none other than Lily\'s prom date: the Senior Class President, Daniel.\r\n\r\nAs the group of pranksters hide cryptic clues across campus for Daniel to find, Lily and Tag find themselves in close quarters. As the exes dodge Campus Safety guards, night owl teachers, a troop of freshmen, and even Daniel himself, new sparks fly. But old hurts and painful secrets refuse to be ignored. And with graduation on the horizon, Lily can only hope that breaking the rules will help mend her heart.', '9781728263137', 'English', 58.50, 18, 2, '2023-10-09 20:13:02'),
(28, 'https://mphonline.com/cdn/shop/products/51vXkvXa1-L._SY291_BO1_204_203_200_QL40_ML2.jpg?v=1686030574&width=480', 'Beyond Measure: The Hidden History of Measurement', 'James Vincent', 'Science Fiction', 'Paperback', 'Faber & Faber', '2023-08-22', 'We measure rainfall and radiation, the depths of space and the emptiness of atoms, calories and steps, happiness and pain. But how did measurement become ubiquitous in modern life? When did humanity first take up scales and rulers, and why does this practice hold authority over so many aspects of our lives?\r\n\r\nWritten with vim and dazzling intelligence, James Vincent provides a fresh and original perspective on human history as he tracks our long search for dependable truths in a chaotic universe. Full of mavericks and visionaries, adventure and the unexpected, Beyond Measure shows that measurement has not only made the world we live in, it has made us too.', '9780571354221', 'English', 82.00, 20, 3, '2023-10-09 20:15:41'),
(29, 'https://mphonline.com/cdn/shop/products/9781802060522-jacket-large.jpg?v=1686019139&width=240', 'How to Prevent the Next Pandemic', 'Bill Gates', 'Science Fiction', 'Paperback', 'Penguin UK', '2023-06-06', 'The COVID-19 pandemic isn\'t over, but even as governments around the world strive to put it behind us, they\'re also starting to talk about what happens next. How can we prevent a new pandemic from killing millions of people and devastating the global economy? Can we even hope to accomplish this?\r\n\r\nBill Gates believes the answer is yes, and in this book he lays out clearly and convincingly what the world should have learned from COVID-19 and what all of us can do to ward off another disaster like it. Relying on the shared knowledge of the world\'s foremost experts and on his own experience of combating fatal diseases through the Gates Foundation, he first makes us understand the science of corona diseases. Then he helps us understand how the nations of the world, working in conjunction with one another and with the private sector, can not only ward off another COVID-like catastrophe but also go far to eliminate all respiratory diseases, including the flu.\r\n\r\nHere is a clarion call - strong, comprehensive, and of the gravest importance - from one of our greatest and most effective thinkers and activists.', '9781802060522', 'English', 69.95, 19, 2, '2023-10-09 20:20:38'),
(30, 'https://mphonline.com/cdn/shop/products/9781841155807-us.jpg?v=1686030582&width=240', 'The Music of the Primes: Searching to Solve the Greatest Mystery in Mathematics', 'Marcus du Sautoy', 'Science Fiction', 'Paperback', 'HarperPerennial UK', '2023-05-15', 'In a stunning, historical narrative, ‘The Music of the Primes’ reveals the history behind one of the biggest ideas in science.\r\n\r\nPrime numbers are the very atoms of arithmetic. They also embody one of the most tantalising enigmas in the pursuit of human knowledge. How can one predict when the next prime number will occur? Is there a formula which could generate primes? These apparently simple questions have confounded mathematicians ever since the Ancient Greeks.\r\n\r\nIn 1859, the brilliant German mathematician Bernard Riemann put forward an idea which finally seemed to reveal a magical harmony at work in the numerical landscape. The promise that these eternal, unchanging numbers would finally reveal their secret thrilled mathematicians around the world. Yet Riemann, a hypochondriac and a troubled perfectionist, never publicly provided a proof for his hypothesis and his housekeeper burnt all his personal papers on his death.\r\n\r\nWhoever cracks Riemann\'s hypothesis will go down in history, for it has implications far beyond mathematics. In business, it is the lynchpin for security and e-commerce. In science, it has critical ramifications in Quantum Mechanics, Chaos Theory, and the future of computing. Pioneers in each of these fields are racing to crack the code and a prize of $1 million has been offered to the winner. As yet, it remains unsolved.\r\n\r\nIn this breathtaking book, mathematician Marcus du Sautoy tells the story of the eccentric and brilliant men who have struggled to solve one of the biggest mysteries in science. It is a story of strange journeys, last-minute escapes from death and the unquenchable thirst for knowledge. Above all, it is a moving and awe-inspiring evocation of the mathematician\'s world and the beauties and mysteries it contains.', '9781841155807', 'English', 62.95, 14, 3, '2023-10-09 20:22:56'),
(31, 'https://mphonline.com/cdn/shop/products/9780593330487.jpg?v=1686030583&width=240', 'The Universe in a Box - Simulations and the Quest to Code the Cosmos', 'Andrew Pontzen', 'Science Fiction', 'Paperback', 'Riverhead Books', '2023-06-13', 'Cosmology is a tricky science—no one can make their own stars, planets, or galaxies to test its theories. But over the last few decades a new kind of physics has emerged to fill the gap between theory and experimentation. Harnessing the power of modern supercomputers, cosmologists have built simulations that offer profound insights into the deep history of our universe, allowing centuries-old ideas to be tested for the first time. Today, physicists are translating their ideas and equations into code, finding that there is just as much to be learned from computers as experiments in laboratories.\r\n\r\nIn The Universe in a Box, cosmologist Andrew Pontzen explains how physicists model the universe’s most exotic phenomena, from black holes and colliding galaxies to dark matter and quantum entanglement, enabling them to study the evolution of virtual worlds and to shed new light on our reality.\r\n\r\nBut simulations don’t just allow experimentation with the cosmos; they are also essential to myriad disciplines like weather forecasting, epidemiology, neuroscience, financial planning, airplane design, and special effects for summer blockbusters. Crafting these simulations involves tough compromises and expert knowledge. Simulation is itself a whole new branch of science, one that we are only just beginning to appreciate and understand. The story of simulations is the thrilling history of how we arrived at our current knowledge of the world around us, and it provides a sneak peek at what we may discover next.', '9780593330487', 'English', 89.95, 25, 3, '2023-10-09 20:24:52'),
(32, 'https://mphonline.com/cdn/shop/files/41kqLDj28EL._SX323_BO1_204_203_200_aee4f59a-ae62-4143-9b8b-90e706b48987.jpg?v=1691481123&width=240', 'This is How You Lose the Time War', 'Amal El-Mohtar ; Max Gladstone', 'Science Fiction', 'Paperback', 'Jo Fletcher Books', '2019-07-18', '\'This book has it all . . . a fireworks display from two very talented storytellers\' Madeline Miller, internationally bestselling author of Circe and Song of Achilles\r\n\r\nAmong the ashes of a dying world, an agent of the Commandant finds a letter. It reads: Burn before reading.\r\nThus begins an unlikely correspondence between two rival agents hellbent on securing the best possible future for their warring factions. Now, what began as a taunt, a battlefield boast, grows into something more. Something epic. Something romantic. Something that could change the past and the future.\r\n\r\nExcept the discovery of their bond would mean death for each of them. There\'s still a war going on, after all. And someone has to win that war. That\'s how war works. Right?\r\n\r\n\'An intimate and lyrical tour of time, myth and history\' John Scalzi, bestselling author of Old Man\'s War\r\n\r\n\'Lyrical and vivid and bittersweet\' Ann Leckie, Hugo Award-winning author of Ancillary Justice\r\n\r\n\'Rich and strange, a romantic tour through all of time and the multiverse\' Martha Wells, Hugo and Nebula Award-winning author of The Murderbot Diaries', '9781529405231', 'English', 69.90, 33, 0, '2023-10-09 20:26:32'),
(33, 'https://mphonline.com/cdn/shop/products/9781250890467.jpg?v=1682411242&width=240', 'The Cradle Of Ice', 'James Rollins', 'Science Fiction', 'Paperback', 'St Martin\'s Press', '2023-03-21', 'To stop the coming apocalypse, a fellowship was formed.\r\n\r\nA soldier, a thief, a lost prince, and a young girl bonded by fate and looming disaster.\r\n\r\nEach step along this path has changed the party, forging deep alliances and greater enmities. All the while, hostile forces have hunted them, fearing what they might unleash. Armies wage war around them. For each step has come with a cost—in blood, in loss, in heartbreak.\r\n\r\nNow, they must split, traveling into a vast region of ice and to a sprawling capital of the world they’ve only known in stories. Time is running out and only the truth will save us all.', '9781250890467', 'English', 95.90, 20, 4, '2023-10-09 20:29:38'),
(34, 'https://mphonline.com/cdn/shop/files/51q-NcBG89L._SY445_SX342.jpg?v=1695711945&width=240', 'Autumn Chills', 'Agatha Christie', 'Crime & Thriller', 'Hardcover', 'HarperFiction', '2023-09-14', 'An all-new collection of autumn-themed mysteries from the master of the genre.\r\n\r\nAutumn is the season of misty mornings and cosy nights in, but as the leaves begin to fall the nights get longer and the shadows grow darker…\r\n\r\nSecluded cottages, eerie manors and ghostly hauntings and cursed tombs abound in this collection of 12 supernatural mysteries and murderous plots featuring Hercule Poirot, Miss Marple and Agatha Christie’s other favourite detectives.', '9780008470975', 'English', 94.50, 20, 11, '2023-10-09 20:33:51');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `guestID` int(11) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT 'Malaysia',
  `postcode` varchar(10) DEFAULT NULL,
  `ccName` varchar(100) DEFAULT NULL,
  `cardNo` bigint(16) DEFAULT NULL,
  `expiry` varchar(10) DEFAULT NULL,
  `cvv` int(3) DEFAULT NULL,
  `ccType` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `total_price` double DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `create_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `user_id` int(11) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT 'Malaysia',
  `postcode` varchar(10) DEFAULT NULL,
  `ccName` varchar(100) DEFAULT NULL,
  `cardNo` bigint(16) DEFAULT NULL,
  `expiry` varchar(10) DEFAULT NULL,
  `cvv` int(3) DEFAULT NULL,
  `ccType` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `form_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `Country` varchar(50) DEFAULT 'Malaysia',
  `City` varchar(50) DEFAULT NULL,
  `State` varchar(50) DEFAULT NULL,
  `Zip` varchar(10) DEFAULT NULL,
  `cardNo` int(16) DEFAULT NULL,
  `expiry` varchar(10) DEFAULT NULL,
  `cvv` int(3) DEFAULT NULL,
  `ccType` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `pwd`, `firstName`, `lastName`, `email`, `phone`, `Address`, `Country`, `City`, `State`, `Zip`, `cardNo`, `expiry`, `cvv`, `ccType`) VALUES
(1, 'hopeen', '$2y$10$9XRmnBECiV7pPypdJSaHKevpaCIcueaXOWtPeJILapGoBBm0JyRlK', 'Hoe Ping', 'Tan', 'hoeping2002@gmail.com', '0187863911', NULL, 'Malaysia', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`guestID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_book_id` (`book_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`form_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_3` (`phone`),
  ADD KEY `phone_2` (`phone`),
  ADD KEY `phone_4` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `guestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_book_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
