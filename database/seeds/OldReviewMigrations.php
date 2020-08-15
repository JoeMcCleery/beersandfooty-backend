<?php

use App\EloquentModels\ContentBlock;
use App\EloquentModels\Review;
use Illuminate\Database\Seeder;
use App\EloquentModels\User;

class OldReviewMigrations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $beerData = array(
            [
                "layout" => "review",
                "pinnedPost" => false,
                "title" => "Colonial Pale Ale",
                "contentBlocks" => [
                    [
                        "type" => "longText",
                        "value" => "Pretty new to the craft beers and what the fuck is this lid. fucking almost cut my fucking lip mate. It tastes pretty good actually but fuck me sort that lid out mate. One thing it does do is make a bloody great ashtray."
                    ],
                    [
                        "type" => "image",
                        "value" => "/uploads/cpl-_good.png"
                    ],
                    [
                        "type" => "score",
                        "value" => 7
                    ]],
                "publishDate" => "1586476800010"
            ],
            [
                "layout" => "review",
                "pinnedPost" => false,
                "title" => "Corona Extra",
                "contentBlocks" => [
                    [
                        "type" => "longText",
                        "value" => "Picked this up on special the other day... only $20 on ebay, it did take a while to get delivered (3 weeks)... still tastes like piss."
                    ],
                    [
                        "type" => "score",
                        "value" => 2
                    ],
                    [
                        "type" => "longText",
                        "value" => "Shove a bit of lime in and your laughing."
                    ],
                    [
                        "type" => "score",
                        "value" => 5
                    ]
                ],
                "publishDate" => "1586476800000"
            ],
            [
                "layout" => "review",
                "pinnedPost" => false,
                "title" => "Single Fin",
                "contentBlocks" => [
                    [
                        "type" => "longText",
                        "value" => "The fussy bastards at Gage Roads are on a winner here. It's not too hoppy but not too light either. Consider this the go to WA local beer now that emu has jumped ship."
                    ],
                    [
                        "type" => "image",
                        "value" => "/uploads/sf6pack.png"
                    ],
                    [
                        "type" => "score",
                        "value" => 7
                    ]
                ],
                "publishDate" => "1586462400010"
            ],
            [
                "layout" => "review",
                "pinnedPost" => false,
                "publishDate" => "1586563200011",
                "title" => "Nail VPA",
                "contentBlocks" => [
                    [
                        "type" => "longText",
                        "value" => "Bit of how ya going 6.5% to wake you up in the mornin is a great start. Huge fruit characters in this one... more fruitiness than fruity lexia mate i'm telling you. Pineapple mate, fkn bit o Daniel Gorringe rhymes with orange, and passionfruit tones. This is not just any pale ale...... its a very pale ale."
                    ],
                    [
                        "type" => "image",
                        "value" => "/uploads/vpa.png"
                    ],
                    [
                        "type" => "score",
                        "value" => 9
                    ]
                ]
            ],
            [
                "layout" => "review",
                "pinnedPost" => false,
                "publishDate" => "1586656800000",
                "title" => "Balter IPA",
                "contentBlocks" => [
                    [
                        "type" => "longText",
                        "value" => "Drinking this beer is like frolicking naked through the field at a packed MCG, then stealing the footy off a bemused umpire and bombing it through the big sticks from 50m on the boundary. It's hoppy base provides a delicious bitterness, and perfectly compliment you beaut aromatics."
                    ],
                    [
                        "type" => "image",
                        "value" => "/uploads/balter-ipa.png"
                    ],
                    [
                        "type" => "score",
                        "value" => 8
                    ]
                ]
            ],
            [
                "layout" => "review",
                "pinnedPost" => false,
                "publishDate" => "1586938846904",
                "title" => "Furphy",
                "contentBlocks" => [
                    [
                        "type" => "longText",
                        "value" => "This beer's name pays respects to the Furphy family, who helped supply Victorian footy clubs with drinking water and sliced oranges for half time. Drawing inspiration from it's history this beer tastes a bit like water, but at $49 a carton and 1.3 standard drinks a pop it's one of the best bang for buck beers out there."
                    ],
                    [
                        "type" => "image",
                        "value" => "/uploads/furphy.jpg"
                    ],
                    [
                        "type" => "score",
                        "value" => 6
                    ]
                ]
            ],
            [
                "layout" => "review",
                "pinnedPost" => false,
                "publishDate" => "1587388618225",
                "title" => "Alby Draught",
                "contentBlocks" => [
                    [
                        "type" => "longText",
                        "value" => "We all know its true, WA has the best greens, and by that i mean barley, but no leaf thanks. Alby is a good classic draught beer at a good price. With an alcohol content of 4.2% you'll probably need a bit of 4.20% to get you a bit messed up, but that's okay. If people catch you with this in your hand it's nothing to be ashamed of."
                    ],
                    [
                        "type" => "image",
                        "value" => "/uploads/alby.jpg"
                    ],
                    [
                        "type" => "score",
                        "value" => 6
                    ]
                ]
            ],
            [
                "layout" => "review",
                "pinnedPost" => false,
                "publishDate" => "1589194320000",
                "title" => "JDH Pale Ale",
                "contentBlocks" => [
                    [
                        "type" => "longText",
                        "value" => "A balanced, refreshing and just drinkable pale ale. Not the most exciting beer but it does the job and hits the spot. Save this beer for the end of your session when your more concerned with being beersy than taste."
                    ],
                    [
                        "type" => "image",
                        "value" => "/uploads/jdh-pale-ale.jpg"
                    ],
                    [
                        "type" => "score",
                        "value" => 5
                    ]
                ]
            ],
            [
                "layout" => "review",
                "pinnedPost" => false,
                "publishDate" => "1587900888384",
                "title" => "Big Shed Brewing Co Boozy Fruit",
                "contentBlocks" => [
                    [
                        "type" => "longText",
                        "value" => "After a big night on the beers i find the best cure for the hangover is either a hair of the dog or some tropical fruit juice. This beer combines both. At 6.2% this beer is the nectar of the god of hangovers - the perfect cure. You have to ask yourself the question; is this beer or is this juice? I dunno i can't tell but its fkn great."
                    ],
                    [
                        "type" => "image",
                        "value" => "/uploads/boozy.png"
                    ],
                    [
                        "type" => "score",
                        "value" => 9
                    ]
                ]
            ],
            [
                "layout" => "review",
                "pinnedPost" => false,
                "publishDate" => "1587874466238",
                "title" => "Innate Brewers  \"Brave New World\" (Double Dry Hopped IPA)",
                "contentBlocks" => [
                    [
                        "type" => "longText",
                        "value" => "Picture this, the year is 2389, the world is in a dark and perilous state. Beers taste like water and AFL tactics have degraded into a game more closely resembling Curling. Two beer smashers travel back in time in search of delicious beer recipe and a more glorious gamestyle for AFL.\n\nCaptain Beers and his sidekick space cadet journey through the local pubs of Australia drinking the kegs dry until they find the most delicious beer:\n\n\"Brave New World\". "
                    ],
                    [
                        "type" => "shortText",
                        "value" => "Captain Beers:\"Aww yeah this'll do 5.8% and bit of El dorado hops\""
                    ],
                    [
                        "type" => "shortText",
                        "value" => "Space Cadet: \"We still need to find a way to fix football\""
                    ],
                    [
                        "type" => "shortText",
                        "value" => "Malcom Blight: \"Hold my Beer\""
                    ],
                    [
                        "type" => "image",
                        "value" => "/uploads/bnw.jpg"
                    ],
                    [
                        "type" => "score",
                        "value" => 9
                    ]
                ]
            ],
            [
                "layout" => "review",
                "pinnedPost" => false,
                "publishDate" => "1588637793408",
                "title" => "Bodriggy Brewing Cucumber & Mint Pilsner",
                "contentBlocks" => [
                    [
                        "type" => "longText",
                        "value" => "So this beer is a cucumber and mint sour pilsner, sounds a bit how's it goin'. After the first sip or two I could tell that this beer does have potential but it also kinda tastes like a mate put some toothpaste in ya beer as a prank. I'm not laughing. If Bodriggy Brewing took out the mint lollies they add during the brewing process then they could be on a winner. A nice refreshing Sour beer to cool off after those long sessions of king of the pack with the boiz."
                    ],
                    [
                        "type" => "image",
                        "value" => "/uploads/bodriggy-sour-pilsner-200220-210319.png"
                    ],
                    [
                        "type" => "score",
                        "value" => 6
                    ]
                ]
            ],
            [
                "layout" => "review",
                "pinnedPost" => false,
                "publishDate" => "1588694400000",
                "title" => "Otherside Brewery Plan C Simple Ale",
                "contentBlocks" => [
                    [
                        "type" => "longText",
                        "value" => "Plan A: Go to the pub to watch the footy\n"
                    ],
                    [
                        "type" => "longText",
                        "value" => "Plan B: Go to your mates to watch the footy"
                    ],
                    [
                        "type" => "longText",
                        "value" => "Plan C: Drink this beer and watch Dwayne Russell, Eddie McGuire and Dermot Brererton recall an AFL game from the 1990s. You know its gonna be shit but its the best damn shit your gonna get during COVID-19. Seriously tho its a pretty tasty simple ale and after a long hard day of working from home you need a good cold plan C and the best plan C is a simple ale and 90s footy. "
                    ],
                    [
                        "type" => "image",
                        "value" => "/uploads/plan-c.jpg"
                    ],
                    [
                        "type" => "score",
                        "value" => 7
                    ]
                ]
            ],
            [
                "layout" => "review",
                "pinnedPost" => false,
                "publishDate" => "1589259654522",
                "title" => "Dainton Brewery Black Magic",
                "contentBlocks" => [
                    [
                        "type" => "longText",
                        "value" => "Dainton has released a salt and pepper squid ink gose. I was expecting this to be extremely dank, but it was actually quite refreshing. Not tasting like liquid squid was a positive to start off with and it has some slight salt and pepper notes and some actual gin. "
                    ],
                    [
                        "type" => "image",
                        "value" => "/uploads/bmagic.png"
                    ],
                    [
                        "type" => "score",
                        "value" => 7
                    ]
                ]
            ],
            [
                "layout" => "review",
                "pinnedPost" => false,
                "publishDate" => "1589607525451",
                "title" => "Pirate Life IIPA",
                "contentBlocks" => [
                    [
                        "type" => "longText",
                        "value" => "This beer is pretty dank but also kinda sweet. I drank one at 3 quarter time while playing in a footy scratch match. I marked the ball in the goal square, was set up to kick the winning goal at full time, but managed to kick it out on the full then yak on the goal umpire. Strong percentage beers will do that to ya, the can I had came in at whopping 500ml with 8.8% of the good stuff per volume. Not Bad, just keep it one ice till after the game."
                    ],
                    [
                        "type" => "image",
                        "value" => "/uploads/pirate_life_iipa__41152.1504504188.500.440.png"
                    ],
                    [
                        "type" => "score",
                        "value" => 8
                    ]
                ]
            ]
        );

        foreach ($beerData as $beerReview) {
            $newReview = new  Review();
            $newReview->user_id = 1;
            $newReview->type = 'beer';
            $newReview->title = $beerReview['title'];
            $newReview->publish_date = $beerReview['publishDate'] / 1000;
            $newReview->status = 'published';
            $newReview->save();

            $blocks = [];
            foreach ($beerReview['contentBlocks'] as $block) {
                $newBlock = new ContentBlock();
                $type = $block['type'];
                if ($type === 'longText') {
                    $type = 'long_text';
                }
                if ($type === 'shortText') {
                    $type = 'short_text';
                }
                $newBlock->type = $type;

                $value = $block['value'];
                if ($type === 'image') {
                    $value = 'http://192.168.1.180:8001/storage' . $value;
                }
                $newBlock->content = $value;
                $newBlock->sort = count($blocks);
                $newBlock->save();

                $blocks[] = $newBlock;
            }

            $newReview->content_blocks()->saveMany($blocks);
        }

        $footyData = array(
            [
                "layout" => "review",
                "pinnedPost" => false,
                "title" => "Season Postponed",
                "contentBlocks" => [
                    [
                        "type" => "shortText",
                        "value" => "Shit's fucked."
                    ],
                    [
                        "type" => "image",
                        "value" => "/uploads/no_footy.jpg"
                    ],
                    [
                        "type" => "score",
                        "value" => 0
                    ]
                ],
                "publishDate" => "1584748800000"
            ],
            [
                "layout" => "review",
                "pinnedPost" => false,
                "title" => "Quarantine Hubs Proposed",
                "contentBlocks" => [
                    [
                        "type" => "longText",
                        "value" => "In partnership with channel 7 the AFL is considering a radical plan to save the AFL season and the clubs from financial ruin. The proposed plan would see three quarantine hubs set up in Tasmania, South Australia and Western Australia.  Each hub would see six teams based in that hub for 3 weeks. Channel 7 is proposing a reality television series where cameras film the players in a lock in local footy club situation where they are locked in the same room with 4000 cartons of vb, XXXX gold and Emu Export for a period of 21 days. The lockin will reportedly be located in large warehouses and last for 21 days and film the antics of the players on the fkn piss. Sources close to the AFL reveal that they are seriously consider the option as they are totally fucked and desperate."
                    ],
                    [
                        "type" => "image",
                        "value" => "/uploads/hubs.png"
                    ]
                ],
                "publishDate" => "1585501200000"
            ],
            [
                "layout" => "review",
                "pinnedPost" => false,
                "publishDate" => "1585627200000",
                "title" => "Nat the Knyfe Fyfe is in Stryfe",
                "contentBlocks" => [
                    [
                        "type" => "longText",
                        "value" => "Superstar Fremantle Captain Nat Fyfe has been snapped in the South West region without a beer in his hand. He was in clear violation of Victorian premier Daniel Andrews directive to Australians to get on the beers. WA police did investigate Fyfe for the alleged breach of community standards. But after further investigation and a statement from the club it was assured that he was extremely pissed."
                    ],
                    [
                        "type" => "image",
                        "value" => "/uploads/natstryfe.jpg"
                    ],
                    [
                        "type" => "score",
                        "value" => 5
                    ]
                ]
            ],
            [
                "layout" => "review",
                "pinnedPost" => false,
                "publishDate" => "1587182297545",
                "title" => "AFL Players Confused About Zoom Beers",
                "contentBlocks" => [
                    [
                        "type" => "longText",
                        "value" => "With no football some players are getting on the turps. Some would say too hard, not me. Lachy \"lightweight\" Hunter evidently misunderstood the meaning of \"Zoom Beers?\" when he decided to get absolutely pissed, get behind the wheel of a car and take out 4 cars including his own. He was so cooked that he continued at kickons with Mullet Man and Lady Gowers. Police found Alcohol in the passenger seat of Hunters car and they refused to rule out the possibility it was cider. We can only speculate."
                    ],
                    [
                        "type" => "image",
                        "value" => "/uploads/zoombeers.png"
                    ],
                    [
                        "type" => "score",
                        "value" => 1
                    ]
                ]
            ],
            [
                "layout" => "review",
                "pinnedPost" => false,
                "publishDate" => "1587549724504",
                "title" => "Huge Night Out, Huge Damage",
                "contentBlocks" => [
                    [
                        "type" => "longText",
                        "value" => "There's nothing worse than checking the bank damage in the morning after getting on the beers at the pub. We've all been there, but Lachie Hunter's $150,000  (15,000 beers) hangover bill is the worst we've ever seen. That's the cost of the repair bill he is facing after getting on the piss and playing demolition derby. Unfortunately he is gonna be drinking Goon from now on."
                    ],
                    [
                        "type" => "score",
                        "value" => 1
                    ]
                ]
            ],
            [
                "layout" => "review",
                "pinnedPost" => false,
                "publishDate" => "1587956441379",
                "contentBlocks" => [
                    [
                        "type" => "longText",
                        "value" => "AFL players are becoming more desperate for the season to restart as willingness to participate in the quarantine hubs increases. Patrick Dangerfield the president of the AFLPA was initially against the idea of setting up quarantine hubs around the country. But now he's more open to the idea as players livelihoods depend on it “To be totally honest, if it’s 16 games in 10 weeks then we’ve just got to find a way.\". AFL players have cut a deal with the AFL that will reduce their pay by 50% with that figure set to increase to 70% if the season is delayed beyond May 31st representing a dramatic decrease in player wages. Despite reports from the pub, Dangerfield did not comment on an alleged sighting of him at Dan Murphy's picking up a carton of hammer and tongs, leading to speculation that AFL players are running out of beer money. It is alleged that the dwindling beer money is the reason behind the players recent backflip on their stance on quarantine hubs."
                    ],
                    [
                        "type" => "image",
                        "value" => "/uploads/dangerfieldmark.png"
                    ],
                    [
                        "type" => "score",
                        "value" => 8
                    ]
                ],
                "title" => "Quarantine Backflip"
            ],
            [
                "layout" => "review",
                "pinnedPost" => false,
                "publishDate" => "1588764726815",
                "title" => "NT Pub Hubs",
                "contentBlocks" => [
                    [
                        "type" => "longText",
                        "value" => "After hitting Coronavirus for 6 the Northern Territory is set to ease social distancing restrictions and allow pubs to reopen as early as May 15th. The reopening of pubs in the NT has brought tears of pride and happiness to the eyes of many Australians and a true blue symbol of hope. AFL players are allegedly now keen to establish so called Pub-Hubs in the Northern Territory to get the season back up and running. The proposal brought forward by Barry from the pub would see AFL teams set up Hubs in an NT Pub where it is understood teams would play a game at the local park and then retire back to the pub for a couple of hard earned frothies."
                    ],
                    [
                        "type" => "score",
                        "value" => 9
                    ]
                ]
            ],
            [
                "layout" => "review",
                "pinnedPost" => false,
                "publishDate" => "1592220803923",
                "title" => "Round 2 Review",
                "contentBlocks" => [
                    [
                        "type" => "longText",
                        "value" => "Footy is back fellas and 2020 continued to deliver with some absolute crapola football, huge upsets and weird scenes all round. Tipping is cooked, AFL fantasy is impossible, but at least it was back and we could all get on the beers and have the thrill of watching our teams get over the line or absolutely spud it up. A week of celebration beers and drowning of sorrows a head as we look forward to round 3"
                    ],
                    [
                        "type" => "shortText",
                        "value" => "Collingwood v Richmond: Title Contenders out defend each other into abysmal draw."
                    ],
                    [
                        "type" => "score",
                        "value" => 7
                    ],
                    [
                        "type" => "shortText",
                        "value" => "Geelong v Hawthorn: Arch rivals show us an abysmal draw is better than a boring belting as Hawks get lost in Geelong."
                    ],
                    [
                        "type" => "score",
                        "value" => 5
                    ],
                    [
                        "type" => "shortText",
                        "value" => "Fremantle v Brisbane: Brisbane prevail in tight contest in first Hub game."
                    ],
                    [
                        "type" => "score",
                        "value" => 7
                    ],
                    [
                        "type" => "shortText",
                        "value" => "Carlton v Melbourne: Game of two halves as both teams remind us that they are still shit."
                    ],
                    [
                        "type" => "score",
                        "value" => 8
                    ],
                    [
                        "type" => "shortText",
                        "value" => "Port Adelaide v Adelaide: Port Adelaide smash arch rivals as 2000 fans tested for Covid."
                    ],
                    [
                        "type" => "score",
                        "value" => 6
                    ],
                    [
                        "type" => "shortText",
                        "value" => "Gold Coast v West Coast: Worst rated team destroys title contenders in one of Gold Coast's greatest wins."
                    ],
                    [
                        "type" => "score",
                        "value" => 9
                    ],
                    [
                        "type" => "shortText",
                        "value" => "Greater Western Sydney v North Melbourne: North Melbourne stun GWS in 20 point win."
                    ],
                    [
                        "type" => "score",
                        "value" => 8
                    ],
                    [
                        "type" => "shortText",
                        "value" => "Sydney v Essendon: Essendon edges Sydney in the Joe Daniher cup."
                    ],
                    [
                        "type" => "score",
                        "value" => 8
                    ],
                    [
                        "type" => "shortText",
                        "value" => "Western Bulldogs v St. Kilda: St. Kilda smash the bulldogs as tipping nightmare continues."
                    ],
                    [
                        "type" => "score",
                        "value" => 5
                    ]
                ]
            ]
        );

        foreach ($footyData as $footyReview) {
            $newReview = new  Review();
            $newReview->user_id = 1;
            $newReview->type = 'footy';
            $newReview->title = $footyReview['title'];
            $newReview->publish_date = $footyReview['publishDate'] / 1000;
            $newReview->status = 'published';
            $newReview->save();

            $blocks = [];
            foreach ($footyReview['contentBlocks'] as $block) {
                $newBlock = new ContentBlock();
                $type = $block['type'];
                if ($type === 'longText') {
                    $type = 'long_text';
                }
                if ($type === 'shortText') {
                    $type = 'short_text';
                }
                $newBlock->type = $type;

                $value = $block['value'];
                if ($type === 'image') {
                    $value = 'https://api.beersandfooty.com/storage' . $value;
                }
                $newBlock->content = $value;
                $newBlock->sort = count($blocks);
                $newBlock->save();

                $blocks[] = $newBlock;
            }

            $newReview->content_blocks()->saveMany($blocks);
        }
    }
}
