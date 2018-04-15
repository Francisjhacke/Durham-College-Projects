using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using CardLib;

namespace DurakCardDemo
{
    public class AIPlayer : Player
    {
        public AIPlayer() : base()
        {

        }

        public override void dealPlayerHand(Deck deck, int start = 0)
        {
            base.dealPlayerHand(deck, start);
            Hand.SortByRank();
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

        public int AttackDecision(double boutCount, Cards boutCards)
        {
            Card attackCard = new Card();
            bool rightCard = false;
            int count = 0;
            int returnValue = -1;   // The value to return (Default = -1)
            if (boutCount < 1)
            {  
                while (rightCard == false)
                {
                    if (count <= Hand.Count)
                    {
                        if (Hand.ElementAt(count).suit != Card.trump)
                            returnValue = count;
                        else
                            count++;
                    }
                    else
                    {
                        returnValue = -1;
                    }
                }
            }
            else // More than 2 bouts
            {
                for (int boutElementCount =0; boutElementCount < boutCards.Count; boutElementCount++)
                {
                    count = 0;
                    rightCard = false;
                    while (rightCard == false)
                    {
                        if (count < Hand.Count)
                        {
                            if (Hand.ElementAt(count).rank == boutCards.ElementAt(boutElementCount).rank)
                            {
                                if (Hand.ElementAt(count).suit != Card.trump)
                                    returnValue = count;
                                else
                                    count++;
                            }
                            else
                                count++;
                        }
                        else
                            rightCard = true;
                    }
                }           
            }
            return returnValue;
        }

        public int DefenseDecision(Card attackCard)
        {
            int handCount = 0;
            bool gotCard = false;
            int returnValue = -1;   // The value to return (Default -1)
            while (gotCard == false)
            {
                if (handCount < Hand.Count)
                {
                    if (Hand.ElementAt(handCount) > attackCard && attackCard.suit != Card.trump)
                    {
                        returnValue = handCount;
                    }
                    else
                    {
                        handCount++;
                    }
                }
                else
                {
                    returnValue = -1;
                }
            }
            return returnValue;
        }

    }
}
