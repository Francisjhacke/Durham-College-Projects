using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using CardLib;

namespace DurakCardDemo
{
    public abstract class Player
    {

        private Cards hand;

        public Player()
        {
            Hand = new Cards();
        }

        public Cards Hand
        {
            get { return hand; }
            set { hand = value; }
        }

        public abstract void AddCardHand(Deck deck);

        public virtual void dealPlayerHand(Deck deck, int start = 0)
        { 
            for (int i = start; i < 6; i++)
            {
                AddCardHand(deck);
            }
        }
    }
}
