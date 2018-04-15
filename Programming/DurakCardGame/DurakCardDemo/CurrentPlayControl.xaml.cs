using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;
using CardLib;

namespace DurakCardDemo
{
    /// <summary>
    /// Interaction logic for CurrentPlayControl.xaml
    /// </summary>
    public partial class CurrentPlayControl : UserControl
    {
        public CurrentPlayControl()
        {
            InitializeComponent();
            format();
        }

        public CurrentPlayControl(CardControl cardOne)
        {
            InitializeComponent();
            playedCardOne = new CardControl(new Card(cardOne.Suit, cardOne.Rank, cardOne.CardImage));
            //format();
        }

        public CurrentPlayControl(CardControl cardOne, CardControl cardTwo)
        {
            InitializeComponent();
            playedCardOne = new CardControl(new Card(cardOne.Suit, cardOne.Rank, cardOne.CardImage));
            playedCardTwo = cardTwo;
            //format();
        }

        private void format()
        {
            this.Width = 71;
            this.Height = 144;
            this.playedCardOne.Width = 71;
            this.playedCardOne.Height = 96;
            this.playedCardTwo.Width = 71;
            this.playedCardTwo.Height = 96;
            this.Visibility = Visibility.Visible;

            this.playedCardOne.Margin = new Thickness(0);
            this.playedCardTwo.Margin = new Thickness(0, 48, 0, 0);
            this.Background = Brushes.Gray;

            this.playedCardOne.Visibility = Visibility.Visible;
            this.playedCardTwo.Visibility = Visibility.Visible;
        }
    }
}
