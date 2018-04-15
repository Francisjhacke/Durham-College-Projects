using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using CardLib;

namespace DurakCardDemo
{
    public class HumanPlayer : Player
    {

        private String playerName;
        private int gamesPlayed;
        private int gamesWon;
        private int gamesLost;

        public HumanPlayer(String playerName, int gamesPlayed, int gamesWon, int gamesLost) : base()
        {
            this.PlayerName = playerName;
            this.GamesPlayed = gamesPlayed;
            this.GamesWon = gamesWon;
            this.GamesLost = gamesLost;
        }

        public override void dealPlayerHand(Deck deck, int start = 0)
        {
            base.dealPlayerHand(deck, start);
            Hand.Sort();
        }

        public override void AddCardHand(Deck deck)
        {

            Hand.Add((deck.GetCard(0).Clone() as Card));

            deck.RemoveCard(deck.GetCard(0));

            Hand.ElementAt(Hand.Count - 1).FaceUp = true;

        }

        public List<CardControl> OutputHand()
        {
            List<CardControl> returnValue = new List<CardControl>(this.Hand.Count);
          
            foreach (Card card in this.Hand)
            {
                returnValue.Add(new CardControl(card));
            }
            return returnValue;
        }

        public bool AttackDecision(double boutCount, Cards boutCards, Card playedCard)
        {

            if (boutCount > 0)
                return boutCards.ContainsByRank(playedCard.rank);
            else
                return true;
        }

        public bool DefenseDecision(Card attackCard, Card defendingCard)
        { 
            return defendingCard > attackCard;
        }

        public String PlayerName
        {
            get { return playerName; }
            set { playerName = value; }
        }

        public int GamesPlayed
        {
            get { return gamesPlayed; }
            set { gamesPlayed = value; }
        }

        public int GamesWon
        {
            get { return gamesWon; }
            set { gamesWon = value; }
        }

        public int GamesLost
        {
            get { return gamesLost; }
            set { gamesLost = value; }
        }
    }
}
