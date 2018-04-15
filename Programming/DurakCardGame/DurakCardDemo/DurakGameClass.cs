using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using CardLib;
using System.IO;

namespace DurakCardDemo
{
    class DurakGameClass
    {

        ///////////////////
        //  PLAYER ID'S  //
        //  0 = H PLAYER //
        //  1 = AI       //
        ///////////////////

        const int PLAYER_COUNT = 2;

        private Deck gameDeck;

        private Card trumpCard;

        private HumanPlayer regularPlayer;

        private AIPlayer aiPlayer;

        public bool endGame = false;

        Bout currentBout;

        public string log = "";

        public DurakGameClass(int deckSize, HumanPlayer playerData)
        {
            // Deck Setup
            this.GameDeck = new Deck(true, true, deckSize);

            // Setup Trump
            this.TrumpCard = GameDeck.GetCard((PLAYER_COUNT * 6) + 1);
            Card.trump = this.TrumpCard.suit;
            GameDeck.RemoveCard((PLAYER_COUNT * 6) + 1);

            // Player Setup
            regularPlayer = playerData;
            regularPlayer.dealPlayerHand(this.GameDeck);

            //WriteLog("Player Hand:\n" + regularPlayer.Hand.ToString());

            // Ai Setup
            aiPlayer = new AIPlayer();
            aiPlayer.dealPlayerHand(this.GameDeck);

            //WriteLog("AI Hand:\n" + aiPlayer.Hand.ToString());

            //Bout Setup
            currentBout = new Bout();

            // Determine First Attack
            Random rand = new Random();

            currentBout.playerTurn = rand.Next(0, 1);

        }

        public Deck GameDeck
        {
            get { return gameDeck; }
            set { gameDeck = value; }
        }

        public Card TrumpCard
        {
            get { return trumpCard; }
            set { trumpCard = value; }
        }

        public HumanPlayer RegularPlayer
        {
            get { return regularPlayer; }
            set { regularPlayer = value; }
        }

        public AIPlayer AIPlayer
        {
            get { return aiPlayer; }
            set { aiPlayer = value; }
        }

        public Bout CurrentBout
        {
            get { return currentBout; }
            set { currentBout = value; }
        }
        

        public void playTurn()
        {
            CurrentBout.boutCount = CurrentBout.boutCount + .5;
            if (currentBout.boutCount > 6 || CurrentBout.endBout == true)
            {
                nextBout();
            }
            else
            {
                currentBout.playerTurn = (currentBout.playerTurn == 0) ? 1 : 0;
                currentBout.turnMode = (currentBout.turnMode == false) ? true : false;
            }
        }

        public void nextBout()
        {

            if (RegularPlayer.Hand.Count < 6)
                RegularPlayer.dealPlayerHand(GameDeck, RegularPlayer.Hand.Count);

            if (AIPlayer.Hand.Count < 6)
                AIPlayer.dealPlayerHand(GameDeck, AIPlayer.Hand.Count);

            WriteLog("\nNew Bout");

            CurrentBout.Initialize();
            currentBout.startPlayer = (currentBout.startPlayer == 0) ? 1 : 0;
            currentBout.playerTurn = currentBout.startPlayer;
            currentBout.turnMode = false;

            if (currentBout.startPlayer == 1)
            {
                AIPlayerTurn();
            }
        }

        public void RegularPlayerTurn(Card playingCard)
        {
            if (currentBout.turnMode == false)
            {
                if (RegularPlayer.AttackDecision(currentBout.boutCount, currentBout.BoutCards, playingCard))
                {
                    currentBout.BoutCards.Add(playingCard);
                    currentBout.lastPlayed = playingCard;
                    RegularPlayer.Hand.Remove(playingCard);

                    WriteLog("\nPlayer attakcs with " + playingCard.ToString());

                    playTurn();

                    AIPlayerTurn();
                }
            }
            else
            {
                if (RegularPlayer.DefenseDecision(currentBout.lastPlayed, playingCard))
                {
                    currentBout.BoutCards.Add(playingCard);
                    currentBout.lastPlayed = playingCard;
                    RegularPlayer.Hand.Remove(playingCard);

                    WriteLog("\nPlayer defends with " + playingCard.ToString());

                    playTurn();

                    AIPlayerTurn();
                }
            }
        }

        public void AIPlayerTurn()
        {
            int index;
            if (currentBout.turnMode == false)
            {
                index = AIPlayer.AttackDecision(currentBout.boutCount, currentBout.BoutCards);

                if (index != -1)
                {
                    Card aiPlayCard = AIPlayer.Hand.ElementAt(index);
                    aiPlayCard.FaceUp = true;
                    currentBout.BoutCards.Add(aiPlayCard);
                    currentBout.lastPlayed = aiPlayCard;
                    AIPlayer.Hand.Remove(aiPlayCard);

                    WriteLog("\nAI attakcs with " + aiPlayCard.ToString());
                }
                else
                {
                    //AIPlayer.Hand.Add(currentBout.lastPlayed);
                    CurrentBout.endBout = true;
                }
            }   
            else
            {
                index = AIPlayer.DefenseDecision(currentBout.lastPlayed);

                if (index != -1)
                {
                    Card aiPlayCard = AIPlayer.Hand.ElementAt(index);
                    aiPlayCard.FaceUp = true;
                    currentBout.BoutCards.Add(aiPlayCard);
                    AIPlayer.Hand.Remove(aiPlayCard);

                    WriteLog("\nAI defended with " + aiPlayCard.ToString());
                }
                else
                {
                    AIPlayer.Hand.AddRange(CurrentBout.BoutCards);
                    AIPlayer.Hand.SortByRank();
                    CurrentBout.endBout = true;
                }

            }
            playTurn();
        }

        public void PlayerPass()
        {
            if (CurrentBout.playerTurn == 0 && CurrentBout.turnMode == true)
            {
                RegularPlayer.Hand.AddRange(CurrentBout.BoutCards);
                RegularPlayer.Hand.Sort();
            }
            nextBout();
        }

        public void WriteLog(String message)
        {
            log += message;
            File.AppendAllText(AppDomain.CurrentDomain.BaseDirectory + "out.txt", message);
        }
    }
}
