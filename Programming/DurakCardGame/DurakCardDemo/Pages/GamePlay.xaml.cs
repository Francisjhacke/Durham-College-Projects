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
using System.IO;
using System.Globalization;

namespace DurakCardDemo.Pages
{
    /// <summary>
    /// Interaction logic for GamePlay.xaml
    /// </summary>
    public partial class GamePlay : Page
    {

        // Holds Spaceing Between Cards
        const int CARDS_IN_HAND = 6;

        DurakGameClass myGame;

        double z = 0;

        const int PLAY_COUNT = 6;

        int deckSizeI;
        int deckSizeC;

        #region "Move Card Variables"
        // Mouses Starting Point
        private System.Windows.Point mouseStartPoint;
        // Element's Original X Left Offest
        private double moveElementOriginalLeft;
        // Element's Original Y Left Offest
        private double moveElementOriginalTop;
        // Current State Of The Button
        private bool IsDown;
        // Determines If The Shap is Being Dragged
        private bool IsDragging;
        // Holds the Object That is being Dragged
        private System.Windows.UIElement OriginalElement;
        // Ghost Object For Dragging
        private System.Windows.Shapes.Rectangle OverlayElement;
        #endregion

        public GamePlay(HumanPlayer playerProfile, int initialDeckSize)
        {
            InitializeComponent();

            this.ccDeckSizeOne.ToString();

            myGame = new DurakGameClass(initialDeckSize, playerProfile);

            deckSizeI = myGame.GameDeck.initialSize;
            deckSizeC = myGame.GameDeck.Length;

            PreviewKeyDown += Window1_PreviewKeyDown;
        }

        private void pgGamePlay_Loaded(object sender, RoutedEventArgs e)
        {
            // Format Screen
            Canvas.SetLeft(brdPlayerHand, 150.9655);
            Canvas.SetLeft(brdAiHand, 150.9655);
            Canvas.SetLeft(dplBoardLayer, 190.4655);

            CardControl trump = new CardControl(myGame.TrumpCard);
            trump.IsTrump = false;
            trump.isFaceUp = true;

            grdTrumpPlaceHolder.Children.Add(trump);

            lblTrump.Content += myGame.TrumpCard.suit.ToString();

            lblPlayerName.Content += myGame.RegularPlayer.PlayerName;
            lblGamesPlayed.Content += myGame.RegularPlayer.GamesPlayed.ToString();
            lblGamesWon.Content += myGame.RegularPlayer.GamesWon.ToString();
            lblGamesLost.Content += myGame.RegularPlayer.GamesLost.ToString();


            RefreshGUI(); 
        }

        private void RefreshGUI()
        {
            tStack.ItemsSource = Resize(myGame.RegularPlayer.OutputHand());
            aiStack.ItemsSource = Resize(myGame.AIPlayer.OutputHand());
            BuildBout();
            txbLog.Text = myGame.log;
        }


        private void CalculateSize(List<CardControl> hand)
        {
            if (hand.Count > 6)
            {
                double x = (dkHand.Width - 71);

                double y = (x / (hand.Count - 1));

                z = 71 - y;
            }
            else
                z = 0;
        }

        private void btnAddCard_Click(object sender, RoutedEventArgs e)
        {
            if (myGame.GameDeck.Length != 0)
            {
                myGame.RegularPlayer.AddCardHand(myGame.GameDeck);

                Resize(myGame.RegularPlayer.OutputHand());

                RefreshGUI();

                tStack.Items.Refresh();
            }
        }

        private void btnAddAiCard_Click(object sender, RoutedEventArgs e)
        {
            if (myGame.GameDeck.Length != 0)
            {
                myGame.AIPlayer.AddCardHand(myGame.GameDeck);

                Resize(myGame.AIPlayer.OutputHand());

                RefreshGUI();

                tStack.Items.Refresh();
            }
        }

        private List<CardControl> Resize(List<CardControl> curHand)
        {
            CalculateSize(curHand);

            int c = 0;
            foreach (CardControl curCard in curHand)
            {
                if (c != 0)
                    curCard.Margin = new Thickness(-z, 0, 0, 0);

                c++;
            }
            return curHand;
        }

        private void buildInPlay(UIElement moveElement)
        {

            //if (stkOne.Children.Count == stkTwo.Children.Count)
            //{
            //    stkOne.Children.Add(moveElement);

            //}
            //else
            //{
            //    stkTwo.Children.Add(moveElement);

            //}

            // Add Card to Bout

            foreach (CardControl item in stkOne.Children)
            {
                item.Margin = new Thickness(0);
            }

            foreach (CardControl item in stkTwo.Children)
            {
                item.Margin = new Thickness(0);
            }


        }

        private void BuildBout()
        {
            stkOne.Children.Clear();
            stkTwo.Children.Clear();
            for (int index = 0; index < myGame.CurrentBout.BoutCards.Count; index++)
            {
                if ((index + 1) % 2 == 1)
                {
                    stkOne.Children.Add(new CardControl(myGame.CurrentBout.BoutCards.ElementAt(index)));
                    (stkOne.Children[stkOne.Children.Count -1] as CardControl).Margin = new Thickness(0);
                }
                else if((index + 1) % 2 == 0)
                {
                    stkTwo.Children.Add(new CardControl(myGame.CurrentBout.BoutCards.ElementAt(index)));
                    (stkTwo.Children[stkTwo.Children.Count - 1] as CardControl).Margin = new Thickness(0);
                }
            }
        }

        #region "Move Card"
        private void MyCanvas_PreviewMouseLeftButtonDown(object sender, System.Windows.Input.MouseButtonEventArgs e)
        {

            //MessageBox.Show(e.Source.ToString());

            if ((tStack.IsMouseOver == true && e.Source.GetType() == typeof(CardControl)) && (stkOne.Children.Count < PLAY_COUNT || stkTwo.Children.Count < PLAY_COUNT))
            {
                // If The Canvas is the what your clicking
                if (object.ReferenceEquals(cvsPlayingScreen, e.Source))
                {
                    // Exits the Method
                    return;
                }

                // Someones Currently Clicking the Mouse
                IsDown = true;
                // Gets the Mouses Starting Point on the Screen
                mouseStartPoint = e.GetPosition(cvsPlayingScreen);
                // Sets The Original Source To The Object That is Currently Geting Touched
                OriginalElement = (System.Windows.UIElement)e.Source;
                // Captures The Current Mouse Position
                //cvsPlayingScreen.CaptureMouse()
                // Has Been Handled
                e.Handled = true;
            }
        }

        private void MyCanvas_PreviewMouseMove(object sender, System.Windows.Input.MouseEventArgs e)
        {
            // If The Mouse Button is Currently being pushed

            if (IsDown)
            {
                // If you are not currently dragging the bbject and your mouse is currently in the same position
                if (!IsDragging && Math.Abs(e.GetPosition(cvsPlayingScreen).X - mouseStartPoint.X) > SystemParameters.MinimumHorizontalDragDistance && Math.Abs(e.GetPosition(cvsPlayingScreen).Y - mouseStartPoint.Y) > SystemParameters.MinimumVerticalDragDistance)
                {
                    // Trigger Drag Started
                    DragStarted();
                }
                // If you are currently dragging the object
                if (IsDragging)
                {
                    // Trigger Drag Moved
                    DragMoved();
                }
            }
        }

        private void DragStarted()
        {
            // Set is dragging to true 
            IsDragging = true;

            // Sets the X, and Y offsets to the current position of the current object
            moveElementOriginalLeft = System.Windows.Input.Mouse.GetPosition(cvsPlayingScreen).X;
            moveElementOriginalTop = System.Windows.Input.Mouse.GetPosition(cvsPlayingScreen).Y;

            // Creates a Visual Brush Object to create a ghost like object that will display the current object
            VisualBrush brush = default(VisualBrush);
            // Sets the brush to the current object
            brush = new VisualBrush(OriginalElement);
            // Sets the transparency to 50%
            brush.Opacity = 0.5;

            // Create's a rectangle to hold the visual brush
            OverlayElement = new System.Windows.Shapes.Rectangle();
            // Sets the width of the rectangle to the original elements width
            OverlayElement.Width = OriginalElement.RenderSize.Width;
            // Sets the width of the rectangle to the original elements height
            OverlayElement.Height = OriginalElement.RenderSize.Height;
            // Set the Rectangles fill to the brush
            OverlayElement.Fill = brush;

            // Add the Overlay Element to the Canvas
            cvsPlayingScreen.Children.Add(OverlayElement);

            lblStatus.Content = "X: " + moveElementOriginalLeft + "\nY: " + moveElementOriginalTop;
        }

        private void DragMoved()
        {
            // Gets the current position of the mouse on the canvas
            System.Windows.Point currentPosition = System.Windows.Input.Mouse.GetPosition(cvsPlayingScreen);
            // Gets the new X position of the Element
            double elementLeft = currentPosition.X - (72 / 2);
            //(currentPosition.X - mouseStartPoint.X) + moveElementOriginalLeft
            // Gets the new Y position of the Element
            double elementTop = currentPosition.Y - (97 / 2);
            // (currentPosition.Y - mouseStartPoint.Y) + moveElementOriginalTop
            // Sets the X position of the overlay Element to the new X position
            Canvas.SetLeft(OverlayElement, elementLeft);
            // Sets the Y position of the overlay Element to the new Y position
            Canvas.SetTop(OverlayElement, elementTop);

            lblStatus.Content = "X: " + elementLeft + "\nY: " + elementTop;
        }

        private void MyCanvas_PreviewMouseLeftButtonUp(object sender, System.Windows.Input.MouseButtonEventArgs e)
        {
            // If the mouse is currently pressed down
            if (IsDown)
            {
                // Trigger Drag Finished
                DragFinished(false);
                // Handled
                e.Handled = true;

            }
        }

        private void Window1_PreviewKeyDown(object sender, System.Windows.Input.KeyEventArgs e)
        {
            // This is handled at the window level, because neither MyCanvas nor
            // its children ever get keyboard focus.
            if (e.Key == System.Windows.Input.Key.Escape && IsDragging)
            {
                DragFinished(true);
            }
        }
        //

        private void DragFinished(bool canceled)
        {
            // Set mouse capture to nothing
            System.Windows.Input.Mouse.Capture(null);
            // If you are currenting dragging the object
            if (IsDragging)
            {
                // Remove the overlay element from the canvas
                cvsPlayingScreen.Children.Remove(OverlayElement);
                // if canceled is equal to false
                if (!canceled)
                {
                    // Set The Original Elements X to the Overlays X position
                    // Canvas.SetLeft(OriginalElement, Canvas.GetLeft(OverlayElement))
                    // Set The Original Elements Y to the Overlays Y position
                    // Canvas.SetTop(OriginalElement, Canvas.GetTop(OverlayElement)

                    if (isOverBoard())
                    {

                        myGame.RegularPlayerTurn(new Card((OriginalElement as CardControl).Suit, (OriginalElement as CardControl).Rank, (OriginalElement as CardControl).CardImage)
                        {
                            FaceUp = true
                        });

                        File.AppendAllText(AppDomain.CurrentDomain.BaseDirectory + "out.txt", "Player Attacked with " + myGame.CurrentBout.lastPlayed.ToString()); 

                        RefreshGUI();

                        //buildInPlay(OriginalElement);

                        //Resize(playerHand);
                    }
                }
                // Sets the overlay element to nothing
                OverlayElement = null;
            }
            // Sets is dragging to false
            IsDragging = false;
            // Sets is mouse down to false
            IsDown = false;
        }

        private bool isOverBoard()
        {
            // Gets The Current Mouse Position 
            System.Windows.Point currentPosition = System.Windows.Input.Mouse.GetPosition(cvsPlayingScreen);
            // Gets the Point of The Board Stack Panel
            System.Windows.Point relativePoint = dplBoardLayer.TransformToAncestor(cvsPlayingScreen).Transform(new System.Windows.Point(0, 0));

            // If The Mouse Is Within The Bounds Of the StackPanel
            if (currentPosition.X >= relativePoint.X & currentPosition.X < (relativePoint.X + dplBoardLayer.Width) & currentPosition.Y >= relativePoint.Y & currentPosition.Y < (relativePoint.Y + dplBoardLayer.Height))
            {
                // Return True
                return true;
            }
            // Return False
            return false;
        }
        #endregion

        private void button_Click(object sender, RoutedEventArgs e)
        {
            myGame.RegularPlayer.Hand.Sort();
            RefreshGUI();
        }
         
        private void AiTurn()
        {
            myGame.AIPlayerTurn();
            RefreshGUI();

        }

        private void tStack_SourceUpdated(object sender, DataTransferEventArgs e)
        {
            tStack.ItemsSource = Resize(myGame.RegularPlayer.OutputHand());
        }

        private void btnPass_Click(object sender, RoutedEventArgs e)
        {
            myGame.PlayerPass();
            RefreshGUI();
        }
    }

    public class CutoffConverter : DependencyObject, IValueConverter
    {
        public object Convert(object value, Type targetType, object parameter, CultureInfo culture)
        {
            return ((int)value) > int.Parse(deckSize.ToString());
        }

        public object ConvertBack(object value, Type targetType, object parameter, CultureInfo culture)
        {
            throw new NotImplementedException();
        }

        public int deckSize { get ; set; }

        static readonly DependencyProperty deckSizeProperty = DependencyProperty.Register("deckSize", typeof(int), typeof(CutoffConverter), new PropertyMetadata(default(int)));

    }
}
