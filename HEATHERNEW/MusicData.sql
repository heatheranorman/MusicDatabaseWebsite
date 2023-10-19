CREATE TABLE artists ( 
	artist_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT , 
	stagename VARCHAR(50) NULL , 
	birthname VARCHAR(50) NOT NULL , 
	DOB DATE NOT NULL , 
	hometown VARCHAR(50) NULL , 
	DOD DATE NULL , 
	funfact TEXT NOT NULL 
) ;

CREATE TABLE genres ( 
	genre_id INT NOT NULL PRIMARY KEY  AUTO_INCREMENT , 
	genre VARCHAR(50) NOT NULL
) ;

CREATE TABLE albums ( 
	album_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT , 
	albumname VARCHAR(50) NOT NULL , 
	artist_id INT NOT NULL , 
	recordlabel VARCHAR(50) NOT NULL , 
	genre_id INT NOT NULL , 
	releasedate DATE NOT NULL , 
	notablefact TEXT NULL,
  FOREIGN KEY (artist_id) REFERENCES artists(artist_id),
	FOREIGN KEY (genre_id) REFERENCES genres(genre_id)
 );

CREATE TABLE songs ( 
	song_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT , 
	songname VARCHAR(50) NOT NULL , 
	artist_id INT NOT NULL , 
	album_id INT NOT NULL  , 
	lengthinseconds INT NOT NULL , 
	comments TEXT NULL , 
	writername VARCHAR(500) NOT NULL , 
  FOREIGN KEY (artist_id) REFERENCES artists(artist_id),
  FOREIGN KEY (album_id) REFERENCES albums(album_id)
);


INSERT INTO artists (stagename, birthname, DOB, hometown, DOD, funfact)
  VALUES 
  ('Adele', 'Adele Laurie Blue Adkins', '1988-05-05', 'Tottenham, London', NULL, 
'Adele stopped reading books at the age of six and concentrated on singing. Matilda by Roald Dahl was the 
last book she remembers reading.'),
    ('Brandon Davis', 'Brandon Michael Davis', '1990-05-08', 'Chattanooga, Tennessee', NULL, 
'Brandon chose to focus on baseball for most of his upbringing, but music was always there to greet him.'),
    ('Tom Petty', 'Thomas Earl Petty', '1950-10-20', 'Gainesville, Florida', '2017-10-02', 
'Tom Petty was also part of a band called Mudcrutch.'),
    ('Kelly Clarkson', 'Kelly Brianne Clarkson', '1982-04-24', 'Fort Worth, Texas', NULL, 
'Before she was the famous singer of “Since U Been Gone,” you may have seen Kelly Clarkson in Arlington, Texas, 
working as a cocktail waitress at a comedy club.'),
    ('Martina McBride', 'Martina Mariea Schiff', '1966-07-29', 'Sharon, Kansas', NULL, 
'Around the age of eight or nine, Martina began singing with a band her father fronted, The Schiffters.'),
    ('Sara Bareilles', 'Sara Beth Bareilles', '1979-12-07', 'Eureka, California', NULL, 
'Sara Bareilles played softball and rode horses while growing up in Northern California.'),
    ('Lenny Kravitz', 'Leonard Albert Kravitz', '1964-05-26', 'Manhattan, New York', NULL, 
'Lenny Kravitz follows veganism with a primarily raw vegan diet, and uses his land in Brazil and the Bahamas to grow his own food.'),
    ('Bethany Dillon', 'Bethany Joy Adelsberger', '1988-09-22', 'Bellefontaine, Ohio', NULL, 
'Bethany Dillon recorded her first independent album at age thirteen.'),
    ('Tim McGraw', 'Samuel Timothy McGraw', '1967-05-01', 'Delhi, Louisiana', NULL, 'Tim McGraw is a licensed pilot!'),
    ('Vanessa Carlton', 'Vanessa Lee Carlton', '1980-08-16', 'Milford, Pennsylvania', NULL, 
'Upon completion of her education at the School of American Ballet, Carlton chose to pursue singing instead, 
performing in New York City bars and clubs while attending college.'),
    ('Stacie Orrico', 'Stacie Joy Orrico', '1986-03-03', 'Seattle, Washington', NULL, 
'Stacie Orrico and family had worked as missionaries in the Ukraine when she was little and they had to sleep in hotels with rats.'),
    ('Reba McEntire', 'Reba Nell McEntire', '1955-03-28', 'McAlester, Oklahoma', NULL, 
'Born and raised on a ranch, McEntire learned the way of ranching through her grandfather and champion steer roper, 
John Wesley. Running their ranch in Chockie, Oklahoma, the singer learned to run a farm, castrate bulls and give them worm medicines. 
Run by her family, each member contributed to running the cattle operation. The McEntire children and her siblings helped around 
the ranch before and after school.');

INSERT INTO genres (genre) 
VALUES 
	('Pop'),
  	('Rock'), 
 	('Christian'), 
 	('Country');

INSERT INTO albums (albumname, artist_id, recordlabel, genre_id, releasedate, notablefact)
VALUES
('30', 1, 'Columbia Records', 2, '2021-11-19', '30 is inspired by Adeles divorce, motherhood, fame, and heartache, 
and expresses themes of acceptance and hope.'), 
('Hearts Dont Rust', 2, 'Big Yellow Dog Music', 3, '2022-04-15', 'NULL'),
('Wildflowers', 3, 'Warner Records Inc.', 1, '1994-11-01', 'Wildflower doesnt advertise its truth, but it summons 
truths anyone can recognize through its subtle, laconic language.'),
('Chemistry', 4, 'Atlantic Recording Corporation', 2, '2023-06-23', '43,000 copies sold in its first week, physical 
sales comprise 25,500 (18,000 on CD and 7,500 on vinyl) and digital album sales comprise 17,500. The set also enters 
at No. 1 on the Vinyl Albums chart.'),
('The Way That I Am', 5, 'Sony Music Entertainment', 3, '1993-09-14', 'NULL'),
('Amidst the Chaos', 6, 'Epic Records', 2, '2019-04-05', 'The album debuted at number six on the US Billboard 200 selling 35,000 
copies in its first week (29,000 of which were traditional album sales), making it Bareilles sixth top 10 album.'),
('Baptism', 7, 'Virgin Records America, Inc.', 2, '2004-05-18', 'NULL'),
('Imagination', 8, 'Sparrow Records', 4, '2005-01-01', 'NULL'),
('Let It Go', 9, 'Curb Records, Inc.', 3, '2007-03-27', 'Let It Go entered the U.S. Billboard 200 at number one with sales 
of 325,000.'),
('Harmonium', 10, 'A&M Records', 2, '2004-11-09', 'NULL'),
('Genuine', 11, 'ForeFront Records', 4, '2000-01-01', 'The first tune is anupbeat song entitled "Ride," which encourages the 
listener to"take a ride to the other side" with the artist into an apparentlyideal world.'),
('Starting Over', 12, 'UMG Recordings, Inc.', 3, '1995-10-03', 'The album peaked at No. 1 on the Billboard country albums 
chart and at No. 5 on the Billboard 200. It was certified Platinum by the RIAA three months after its release.');


INSERT INTO songs (songname, artist_id, album_id, lengthinseconds, comments, writername)
VALUES
('Strangers By Nature', 1, 1, 182, 'NULL', 'Adele, Ludwig Goransson'),
('Easy On Me', 1, 1, 285, 'NULL', 'Adele, Greg Kurstin'),
('My Little Love', 1, 1, 389, 'NULL', 'Adele, Greg Kurstin'),
('Cry Your Heart Out', 1, 1, 255, 'NULL', 'Adele, Greg Kurstin'),
('Oh My God', 1, 1, 225, 'NULL', 'Adele, Greg Kurstin'),
('Can I Get It', 1, 1, 211, 'NULL', 'Adele, Max Martin, Shellback, Tobias Jesso Jr.'),
('I Drink Wine', 1, 1, 376, 'NULL', 'Adele, Greg Kurstin'),
('All Night Parking', 1, 1, 162, 'NULL', 'Adele, Erroll Garner'),
('Woman Like Me', 1, 1, 300, 'NULL', 'Adele, Dean Josiah Cover'),
('Hold On', 1, 1, 365, 'NULL', 'Adele, Dean Josiah Cover'),
('To Be Loved', 1, 1, 404, 'NULL', 'Adele, Tobias Jesso Jr.'),
('Love Is A Game', 1, 1, 403, 'NULL', 'Adele, Dean Josiah Cover'),

('Hearts Dont Rust', 2, 2, 250, 'NULL', 'Richard Brandon Davis'),
('Running Out Of Roses', 2, 2, 211, 'NULL', 'Alex Pennington Smith, Richard Brandon Davis, Sam Koon'),
('Somethings Better Than Nothing', 2, 2, 201, 'NULL', 'Jason Duke, Kyle Clark, Richard Brandon Davis'),
('Somebodys Gotta Do It', 2, 2, 183, 'NULL', 'Alex Pennington Smith, Josh Bricker, Richard Brandon Davis, Sam Koon'),
('Speaking My Language', 2, 2, 186, 'NULL', 'Alex Pennington Smith, Josh Byrd, Richard Brandon Davis'),
('Hey Baby', 2, 2, 225, 'NULL', 'Josh Bricker, Richard Brandon Davis'),
('Hits Different', 2, 2, 179, 'NULL', 'Josh Bricker, Richard Brandon Davis'),
('Tequila and Opinions', 2, 2, 204, 'NULL', 'Alex Pennington Smith, Kyle Clark, Richard Brandon Davis'),

('Wildflowers', 3, 3, 192, 'NULL', 'Thomas Earl Petty'),
('You Dont Know How It Feels', 3, 3, 289, 'NULL', 'Thomas Earl Petty'),
('Time To Move On', 3, 3, 195, 'NULL', 'Thomas Earl Petty'),
('You Wreck Me', 3, 3, 202, 'NULL', 'Mike Campbell, Thomas Earl Petty'),
('Only a Broken Heart', 3, 3, 271, 'NULL', 'Thomas Earl Petty'),
('Honey Bee', 3, 3, 298, 'NULL', 'Thomas Earl Petty'),
('To Find A Friend', 3, 3, 203, 'NULL', 'Thomas Earl Petty'),

('Mine', 4, 4, 218, 'NULL', 'Erick Serna, Jessie Shatkin, Kelly Clarkson'),
('High Road', 4, 4, 199, 'NULL', 'Justin Womble, Rachel Orscher'),
('Me', 4, 4, 199, 'NULL', 'GAYLE, Josh Ronen, Kelly Clarkson'),
('Down To You', 4, 4, 215, 'NULL', 'Jesse Shatkin, Kelly Clarkson, Maureen McDonald'),
('Chemistry', 4, 4, 189, 'NULL', 'Erick Serna, Jessie Shatkin, Kelly Clarkson'),
('Favorite Kind Of High', 4, 4, 151, 'NULL', 'Carly Rae Jepsen, Jesse Shatkin, Kelly Clarkson'),
('Magic', 4, 4, 195, 'NULL', 'Jesse Shatkin, Kelly Clarkson, Randy Runyon'),
('Lighthouse', 4, 4, 201, 'NULL', 'Aben Eubanks, Jesse Shatkin, Kelly Clarkson'),
('Rock Hudson', 4, 4, 202, 'NULL', 'Jessie Shatkin, Kelly Clarkson'),
('My Mistake', 4, 4, 197, 'NULL', 'Alex Hope, Jessie Shatkin, Sean Douglas'),

('Heart Trouble', 5, 5, 197, 'NULL', 'Paul Kennerley'),
('My Baby Loves Me', 5, 5, 155, 'NULL', 'Gretchen Peters'),
('That Wasnt Me', 5, 5, 224, 'NULL', 'Gary Harrison, Tim Mensy'),
('Independence Day', 5, 5, 204, 'NULL', 'Gretchen Peters'),
('Where I Used To Have A Heart', 5, 5, 230, 'NULL', 'Craig Bickhardt'),
('Goin To Work', 5, 5, 208, 'NULL', 'Bill Lloyd, Pam Tillis'),
('Life #9', 5, 5, 272, 'NULL', 'Kostas, Tony Perez'),
('Strangers', 5, 5, 201, 'NULL', 'Bobby Braddock'),
('Ashes', 5, 5, 175, 'NULL', 'Charlotte Wilson, Chris Waters, Lonnie Wilson'),

('Fire', 6, 6, 229, 'NULL', 'Sara Bareilles'),
('No Such Thing', 6, 6, 237, 'NULL', 'Justin Tranter, Sara Bareilles'),
('Armor', 6, 6, 269, 'NULL', 'Sara Bareilles'),
('Eyes on You', 6, 6, 244, 'NULL', 'Sara Bareilles'),
('Miss Simone', 6, 6, 253, 'NULL', 'Lorie McKenna, Sara Bareilles'),
('Wicked Love', 6, 6, 279, 'NULL', 'Sara Bareilles'),
('Orpheus', 6, 6, 253, 'NULL', 'Sara Bareilles'),
('Poetry By Dead Men', 6, 6, 228, 'NULL', 'Justin Tranter, Sara Bareilles'),
('Someone Who Loves Me', 6, 6, 197, 'NULL', 'Sara Bareilles'),
('Saint Honesty', 6, 6, 274, 'NULL', 'Lori McKenna, Sara Bareilles'),
('A Safe Place To Land', 6, 6, 269, 'NULL', 'Lori McKenna, Sara Bareilles'),

('Lady', 7, 7, 256, 'NULL', 'Craig Ross, Lenny Kravitz'),
('Calling All Angels', 7, 7, 312, 'NULL', 'Lenny Kravitz'),
('California', 7, 7, 156, 'NULL', 'Lenny Kravitz'),
('Sistamamalover', 7, 7, 269, 'NULL', 'Lenny Kravitz'),
('Baptized', 7, 7, 288, 'NULL', 'Gerry DeVeaux, Lenny Kravitz, Terry Britten'),
('Flash', 7, 7, 252, 'NULL', 'Lenny Kravitz'),
('Destiny', 7, 7, 295, 'NULL', 'James Read, Richie, Lenny Kravitz'),


('Dreamer', 8, 8, 225, 'NULL', 'Bethany Dillon, Ed Cash'),
('Hallelujah', 8, 8, 244, 'NULL', 'Bethany Dillon, Ed Cash'),
('All That I Can Do', 8, 8, 217, 'NULL', 'Bethany Dillon, Dave Barnes, Ed Cash'),
('Airplane', 8, 8, 260, 'NULL', 'Bethany Dillon, Ed Cash'),
('I Believe In You', 8, 8, 248, 'NULL', 'Bethany Dillon, Ed Cash'),
('New', 8, 8, 235, 'NULL', 'Jeff Roach'),
('The Way I See You', 8, 8, 276, 'NULL', 'Bethany Dillon, Ed Cash'),
('Imagination', 8, 8, 547, 'NULL', 'Bethany Dillon'),


('Last Dollar (Fly Away)', 9, 9, 270, 'NULL', 'Big Kenny'),
('Let It Go', 9, 9, 224, 'NULL', 'Aimee Mayo, William C Luther, Tom Douglas'),
('Whiskey And You', 9, 9, 226, 'NULL', 'Chris Stapleton, Lee Thomas Miller'),
('Suspicions', 9, 9, 314, 'NULL', 'David Malloy, Eddie Rabbitt, Even Stevens, Randy McCormick'),
('Kristofferson', 9, 9, 202, 'NULL', 'Anthony Smith, Reed Nielson'),
('Put Your Lovin On Me', 9, 9, 212, 'NULL', 'Hillary Lindsey, Luke Laird'),
('Nothin To Die For', 9, 9, 251, 'NULL', 'Craig Wiseman, Lee Thomas Miller'),
('Between The River And Me', 9, 9, 232, 'NULL', 'Brad Warren, Brett Beavers, Brett Warren'),
('Train #10', 9, 9, 238, 'NULL', 'Brad Warren, Brett Warren, Tim McGraw'),
('I Need You', 9, 9, 247, 'NULL', 'David Lee, Tony Lane'),

('White Houses', 10, 10, 225, 'NULL', 'Stephan Jenkins, Vanessa Carlton'),
('Annie', 10, 10, 288, 'NULL', 'Stephan Jenkins, Vanessa Carlton'),
('Afterglow', 10, 10, 236, 'NULL', 'Vanessa Carlton'),
('Private Radio', 10, 10, 179, 'NULL', 'Stephan Jenkins, Vanessa Carlton'),
('Half A Week Before The Winter', 10, 10, 207, 'NULL', 'Vanessa Carlton'),
('Papa', 10, 10, 159, 'NULL', 'Vanessa Carlton'),
('She Floats', 10, 10, 315, 'NULL', 'Vanessa Carlton'),


('Dont Look At Me', 11, 11, 216, 'NULL', 'Mark Heimermann, Stacie Orrico'),
('Without Love', 11, 11, 291, 'NULL', 'Eddie DeFarmo, Tedd Tjornhom'),
('Stay True', 11, 11, 198, 'NULL', 'Charity, Mark Heimermann'),
('Genuine', 11, 11, 300, 'NULL', 'B Huston, Stacie Orrico, Tedd Tjornhom'),
('With A Little Faith', 11, 11, 231, 'NULL', 'David Wyatt, Lisa Kimmey, Michael Quinlan'),
('Holdin On', 11, 11, 269, 'NULL', 'Bob Farrell, Michael Quinlan'),
('Restore My Soul', 11, 11, 305, 'NULL', 'Ken Harrell'),
('Dear Friend', 11, 11, 265, 'NULL', 'Stacie Orrico'),


('Talking In Your Sleep', 12, 12, 265, 'NULL', 'Bobby Wood, Roger Cook'),
('Please Come To Boston', 12, 12, 281, 'NULL', 'Dave Loggins'),
('On My Own', 12, 12, 273, 'NULL', 'Burt Bacharach, Carole Bayer Sager'),
('I Wont Mention It Again', 12, 12, 254, 'NULL', 'Cameron L Mullins, Carolyn Jean Yates'),
('Ring On Her Finger, Time On My Hands', 12, 12, 253, 'NULL', 'Don Goodman, Mary Ann Kennedy, Pam Rose'),
('Five Hundred Miles Away From Home', 12, 12, 265, 'NULL', 'Bobby Bare, Charlie Williams, Hedy West'),
('Starting Over Again', 12, 12, 251, 'NULL', 'Bruce Sudana, Donna Summer'),
('You Keep Me Hanging On', 12, 12, 205, 'NULL', 'Brian Holland, Edward Holland Jr., Lamont Dozier'),
('By The Time I Get To Phoenix', 12, 12, 244, 'NULL', 'Jim Webb');