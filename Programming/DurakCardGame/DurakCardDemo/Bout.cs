using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using CardLib;

namespace DurakCardDemo
{
    class Bout
    {
        public bool turnMode = false;

        public double boutCount = 0;
        public int playerTurn = 0;

        public int startPlayer = 0;

        public bool endBout = false;
        public Card lastPlayed;

        private Cards boutCards;

        public Bout()
        {
            Initialize();
        }

        public void Initialize()
        {
            BoutCards = new Cards();
            lastPlayed = new Card();
            boutCount = 0;
            endBout = false;

        }

        public Cards BoutCards
        {
            get { return boutCards; }
            set { boutCards = value; }
        }
    }
}
