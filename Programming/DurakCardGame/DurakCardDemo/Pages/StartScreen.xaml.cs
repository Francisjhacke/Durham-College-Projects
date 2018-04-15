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
using System.IO;
using System.Windows.Media.Animation;

namespace DurakCardDemo.Pages
{
    /// <summary>
    /// Interaction logic for StartScreen.xaml
    /// </summary>
    public partial class StartScreen : Page
    {
        bool isNew = false;

        string[] playerLines = System.IO.File.ReadAllLines(AppDomain.CurrentDomain.BaseDirectory + "player.dat");

        List<string[]> players = new List<string[]>();

        RadioButton[] deckSizeGroup;
        public StartScreen()
        {
            InitializeComponent();

            if (File.Exists(AppDomain.CurrentDomain.BaseDirectory + "player.dat"))
            {

                System.IO.StreamReader file = new System.IO.StreamReader(AppDomain.CurrentDomain.BaseDirectory + "player.dat");

                String line;
                string[] words;
                while ((line = file.ReadLine()) != null)
                {
                    words = line.Split(',');

                    players.Add(words);
                }

                lbPlayers.ItemsSource = players;
                file.Close();
            }

            deckSizeGroup = new RadioButton[3] { rbDeckSize20, rbDeckSize36, rbDeckSize52 };
        }

        private void btnPlay_MouseEnter(object sender, MouseEventArgs e)
        {
            (sender as Button).Foreground = Brushes.Green;
            (sender as Button).BorderBrush = Brushes.Transparent;
            (sender as Button).Background = Brushes.Transparent;
        }

        private void btnPlay_MouseLeave(object sender, MouseEventArgs e)
        {
            (sender as Button).Foreground = Brushes.Red;
        }

        private void lblPlay_MouseLeftButtonDown(object sender, MouseButtonEventArgs e)
        {
            if (lbPlayers.SelectedIndex != -1)
            {

                GamePlay GameWindow = new GamePlay(new HumanPlayer((lbPlayers.SelectedItem as string[])[0],
                                                                int.Parse((lbPlayers.SelectedItem as string[])[1]),
                                                                int.Parse((lbPlayers.SelectedItem as string[])[2]),
                                                                int.Parse((lbPlayers.SelectedItem as string[])[3])),
                                                                int.Parse(deckSizeGroup.Where(rb => rb.IsChecked == true).ElementAt(0).Tag.ToString()));

                this.NavigationService.Navigate(GameWindow);
            }
            else
            {
                MessageBox.Show("No Player Selected", "Warning", MessageBoxButton.OK, MessageBoxImage.Warning);
            }
        }

        private void lblPlay_MouseEnter(object sender, MouseEventArgs e)
        {
            (sender as Label).Foreground = Brushes.Green;
        }

        private void lblPlay_MouseLeave(object sender, MouseEventArgs e)
        {
            (sender as Label).Foreground = Brushes.Red;
        }

        private void btnAddPlayer_Click(object sender, RoutedEventArgs e)
        {
            isNew = true;

            btnCancelPlayer.IsEnabled = true;
            rctPlayerBack.IsEnabled = true;
            ((Storyboard)FindResource("FadeIn")).Begin(rctPlayerBack);
            ((Storyboard)FindResource("FadeIn")).Begin(grdNewPlayer);
        }

        private void rctPlayerBack_PreviewMouseDown(object sender, MouseButtonEventArgs e)
        {
            FadeOut();
        }

        private void btnAcceptPlayer_Click(object sender, RoutedEventArgs e)
        {
            if (txtPlayerName.Text != null)
            {
                if (isNew)
                {
                    if (players.Count(c => c[0] == txtPlayerName.Text) == 0)
                    {
                        players.Add(new string[] { txtPlayerName.Text, "0", "0", "0" });
                        WritePlayers();
                        FadeOut();
                    }
                    else
                    {
                        MessageBox.Show("This player already exists please select another name", "Warning", MessageBoxButton.OK, MessageBoxImage.Warning);
                    }
                }
                else
                {

                }
            }
        }

        private void WritePlayers()
        {
            StringBuilder playerBuild = new StringBuilder();
            for (int index = 0; index < players.Count; index++)
            {
                playerBuild.Append(String.Join(",", players[index]) + "\n");
            }
            File.WriteAllText(AppDomain.CurrentDomain.BaseDirectory + "player.dat", playerBuild.ToString(), Encoding.UTF8);
        }

        private void btnCancelPlayer_Click(object sender, RoutedEventArgs e)
        {
            FadeOut();
        }

        private void FadeOut()
        {
            isNew = false;
            btnCancelPlayer.IsEnabled = false;
            rctPlayerBack.IsEnabled = false;
            txtPlayerName.Clear();
            ((Storyboard)FindResource("FadeOut")).Begin(rctPlayerBack);
            ((Storyboard)FindResource("FadeOut")).Begin(grdNewPlayer);

            lbPlayers.Items.Refresh();
        }

        private void btnDeletePlayer_Click(object sender, RoutedEventArgs e)
        {
            if (lbPlayers.SelectedValue != null)
            {
                players.Remove((String[])lbPlayers.SelectedValue);
                WritePlayers();
                lbPlayers.Items.Refresh();
            }
        }
    }
}
