﻿#pragma checksum "..\..\..\Pages\GamePlay.xaml" "{406ea660-64cf-4c82-b6f0-42d48172a799}" "0E40F83416DD8D299536801C50C1078B"
//------------------------------------------------------------------------------
// <auto-generated>
//     This code was generated by a tool.
//     Runtime Version:4.0.30319.42000
//
//     Changes to this file may cause incorrect behavior and will be lost if
//     the code is regenerated.
// </auto-generated>
//------------------------------------------------------------------------------

using CardLib;
using DurakCardDemo.Pages;
using System;
using System.Diagnostics;
using System.Windows;
using System.Windows.Automation;
using System.Windows.Controls;
using System.Windows.Controls.Primitives;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Ink;
using System.Windows.Input;
using System.Windows.Markup;
using System.Windows.Media;
using System.Windows.Media.Animation;
using System.Windows.Media.Effects;
using System.Windows.Media.Imaging;
using System.Windows.Media.Media3D;
using System.Windows.Media.TextFormatting;
using System.Windows.Navigation;
using System.Windows.Shapes;
using System.Windows.Shell;


namespace DurakCardDemo.Pages {
    
    
    /// <summary>
    /// GamePlay
    /// </summary>
    public partial class GamePlay : System.Windows.Controls.Page, System.Windows.Markup.IComponentConnector, System.Windows.Markup.IStyleConnector {
        
        
        #line 1 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal DurakCardDemo.Pages.GamePlay pgGamePlay;
        
        #line default
        #line hidden
        
        
        #line 18 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.Canvas cvsPlayingScreen;
        
        #line default
        #line hidden
        
        
        #line 21 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.Label lblStatus;
        
        #line default
        #line hidden
        
        
        #line 22 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.Label lblTrump;
        
        #line default
        #line hidden
        
        
        #line 24 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.Button btnAddCard;
        
        #line default
        #line hidden
        
        
        #line 25 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.Button btnAddAiCard;
        
        #line default
        #line hidden
        
        
        #line 28 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.Border brdAiHand;
        
        #line default
        #line hidden
        
        
        #line 35 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.DockPanel dkAIHand;
        
        #line default
        #line hidden
        
        
        #line 36 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.ItemsControl aiStack;
        
        #line default
        #line hidden
        
        
        #line 58 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.DockPanel dplBoardLayer;
        
        #line default
        #line hidden
        
        
        #line 59 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.StackPanel stckBoard;
        
        #line default
        #line hidden
        
        
        #line 60 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.StackPanel stkOne;
        
        #line default
        #line hidden
        
        
        #line 67 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.StackPanel stkTwo;
        
        #line default
        #line hidden
        
        
        #line 79 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.Border brdPlayerHand;
        
        #line default
        #line hidden
        
        
        #line 86 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.DockPanel dkHand;
        
        #line default
        #line hidden
        
        
        #line 88 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.ItemsControl tStack;
        
        #line default
        #line hidden
        
        
        #line 102 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.Grid grdTrumpPlaceHolder;
        
        #line default
        #line hidden
        
        
        #line 124 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal CardLib.CardControl ccDeckSizeOne;
        
        #line default
        #line hidden
        
        
        #line 125 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal CardLib.CardControl ccDeckSizeTwo;
        
        #line default
        #line hidden
        
        
        #line 126 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal CardLib.CardControl ccDeckSizeThree;
        
        #line default
        #line hidden
        
        
        #line 139 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.Button button;
        
        #line default
        #line hidden
        
        
        #line 140 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.Button btnPass;
        
        #line default
        #line hidden
        
        
        #line 142 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.TextBlock txbLog;
        
        #line default
        #line hidden
        
        
        #line 144 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.Label lblPlayerName;
        
        #line default
        #line hidden
        
        
        #line 145 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.Label lblGamesPlayed;
        
        #line default
        #line hidden
        
        
        #line 146 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.Label lblGamesWon;
        
        #line default
        #line hidden
        
        
        #line 147 "..\..\..\Pages\GamePlay.xaml"
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1823:AvoidUnusedPrivateFields")]
        internal System.Windows.Controls.Label lblGamesLost;
        
        #line default
        #line hidden
        
        private bool _contentLoaded;
        
        /// <summary>
        /// InitializeComponent
        /// </summary>
        [System.Diagnostics.DebuggerNonUserCodeAttribute()]
        [System.CodeDom.Compiler.GeneratedCodeAttribute("PresentationBuildTasks", "4.0.0.0")]
        public void InitializeComponent() {
            if (_contentLoaded) {
                return;
            }
            _contentLoaded = true;
            System.Uri resourceLocater = new System.Uri("/DurakCardDemo;component/pages/gameplay.xaml", System.UriKind.Relative);
            
            #line 1 "..\..\..\Pages\GamePlay.xaml"
            System.Windows.Application.LoadComponent(this, resourceLocater);
            
            #line default
            #line hidden
        }
        
        [System.Diagnostics.DebuggerNonUserCodeAttribute()]
        [System.CodeDom.Compiler.GeneratedCodeAttribute("PresentationBuildTasks", "4.0.0.0")]
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1811:AvoidUncalledPrivateCode")]
        internal System.Delegate _CreateDelegate(System.Type delegateType, string handler) {
            return System.Delegate.CreateDelegate(delegateType, this, handler);
        }
        
        [System.Diagnostics.DebuggerNonUserCodeAttribute()]
        [System.CodeDom.Compiler.GeneratedCodeAttribute("PresentationBuildTasks", "4.0.0.0")]
        [System.ComponentModel.EditorBrowsableAttribute(System.ComponentModel.EditorBrowsableState.Never)]
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Design", "CA1033:InterfaceMethodsShouldBeCallableByChildTypes")]
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Maintainability", "CA1502:AvoidExcessiveComplexity")]
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1800:DoNotCastUnnecessarily")]
        void System.Windows.Markup.IComponentConnector.Connect(int connectionId, object target) {
            switch (connectionId)
            {
            case 1:
            this.pgGamePlay = ((DurakCardDemo.Pages.GamePlay)(target));
            
            #line 9 "..\..\..\Pages\GamePlay.xaml"
            this.pgGamePlay.Loaded += new System.Windows.RoutedEventHandler(this.pgGamePlay_Loaded);
            
            #line default
            #line hidden
            return;
            case 2:
            this.cvsPlayingScreen = ((System.Windows.Controls.Canvas)(target));
            
            #line 18 "..\..\..\Pages\GamePlay.xaml"
            this.cvsPlayingScreen.MouseLeftButtonDown += new System.Windows.Input.MouseButtonEventHandler(this.MyCanvas_PreviewMouseLeftButtonDown);
            
            #line default
            #line hidden
            
            #line 18 "..\..\..\Pages\GamePlay.xaml"
            this.cvsPlayingScreen.MouseLeftButtonUp += new System.Windows.Input.MouseButtonEventHandler(this.MyCanvas_PreviewMouseLeftButtonUp);
            
            #line default
            #line hidden
            
            #line 18 "..\..\..\Pages\GamePlay.xaml"
            this.cvsPlayingScreen.MouseMove += new System.Windows.Input.MouseEventHandler(this.MyCanvas_PreviewMouseMove);
            
            #line default
            #line hidden
            return;
            case 3:
            this.lblStatus = ((System.Windows.Controls.Label)(target));
            return;
            case 4:
            this.lblTrump = ((System.Windows.Controls.Label)(target));
            return;
            case 5:
            this.btnAddCard = ((System.Windows.Controls.Button)(target));
            
            #line 24 "..\..\..\Pages\GamePlay.xaml"
            this.btnAddCard.Click += new System.Windows.RoutedEventHandler(this.btnAddCard_Click);
            
            #line default
            #line hidden
            return;
            case 6:
            this.btnAddAiCard = ((System.Windows.Controls.Button)(target));
            
            #line 25 "..\..\..\Pages\GamePlay.xaml"
            this.btnAddAiCard.Click += new System.Windows.RoutedEventHandler(this.btnAddAiCard_Click);
            
            #line default
            #line hidden
            return;
            case 7:
            this.brdAiHand = ((System.Windows.Controls.Border)(target));
            return;
            case 8:
            this.dkAIHand = ((System.Windows.Controls.DockPanel)(target));
            return;
            case 9:
            this.aiStack = ((System.Windows.Controls.ItemsControl)(target));
            return;
            case 11:
            this.dplBoardLayer = ((System.Windows.Controls.DockPanel)(target));
            return;
            case 12:
            this.stckBoard = ((System.Windows.Controls.StackPanel)(target));
            return;
            case 13:
            this.stkOne = ((System.Windows.Controls.StackPanel)(target));
            return;
            case 14:
            this.stkTwo = ((System.Windows.Controls.StackPanel)(target));
            return;
            case 15:
            this.brdPlayerHand = ((System.Windows.Controls.Border)(target));
            return;
            case 16:
            this.dkHand = ((System.Windows.Controls.DockPanel)(target));
            return;
            case 17:
            this.tStack = ((System.Windows.Controls.ItemsControl)(target));
            
            #line 88 "..\..\..\Pages\GamePlay.xaml"
            this.tStack.SourceUpdated += new System.EventHandler<System.Windows.Data.DataTransferEventArgs>(this.tStack_SourceUpdated);
            
            #line default
            #line hidden
            return;
            case 19:
            this.grdTrumpPlaceHolder = ((System.Windows.Controls.Grid)(target));
            return;
            case 20:
            this.ccDeckSizeOne = ((CardLib.CardControl)(target));
            return;
            case 21:
            this.ccDeckSizeTwo = ((CardLib.CardControl)(target));
            return;
            case 22:
            this.ccDeckSizeThree = ((CardLib.CardControl)(target));
            return;
            case 23:
            this.button = ((System.Windows.Controls.Button)(target));
            
            #line 139 "..\..\..\Pages\GamePlay.xaml"
            this.button.Click += new System.Windows.RoutedEventHandler(this.button_Click);
            
            #line default
            #line hidden
            return;
            case 24:
            this.btnPass = ((System.Windows.Controls.Button)(target));
            
            #line 140 "..\..\..\Pages\GamePlay.xaml"
            this.btnPass.Click += new System.Windows.RoutedEventHandler(this.btnPass_Click);
            
            #line default
            #line hidden
            return;
            case 25:
            this.txbLog = ((System.Windows.Controls.TextBlock)(target));
            return;
            case 26:
            this.lblPlayerName = ((System.Windows.Controls.Label)(target));
            return;
            case 27:
            this.lblGamesPlayed = ((System.Windows.Controls.Label)(target));
            return;
            case 28:
            this.lblGamesWon = ((System.Windows.Controls.Label)(target));
            return;
            case 29:
            this.lblGamesLost = ((System.Windows.Controls.Label)(target));
            return;
            }
            this._contentLoaded = true;
        }
        
        [System.Diagnostics.DebuggerNonUserCodeAttribute()]
        [System.CodeDom.Compiler.GeneratedCodeAttribute("PresentationBuildTasks", "4.0.0.0")]
        [System.ComponentModel.EditorBrowsableAttribute(System.ComponentModel.EditorBrowsableState.Never)]
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Design", "CA1033:InterfaceMethodsShouldBeCallableByChildTypes")]
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Performance", "CA1800:DoNotCastUnnecessarily")]
        [System.Diagnostics.CodeAnalysis.SuppressMessageAttribute("Microsoft.Maintainability", "CA1502:AvoidExcessiveComplexity")]
        void System.Windows.Markup.IStyleConnector.Connect(int connectionId, object target) {
            switch (connectionId)
            {
            case 10:
            
            #line 39 "..\..\..\Pages\GamePlay.xaml"
            ((System.Windows.Controls.StackPanel)(target)).MouseLeftButtonDown += new System.Windows.Input.MouseButtonEventHandler(this.MyCanvas_PreviewMouseLeftButtonDown);
            
            #line default
            #line hidden
            break;
            case 18:
            
            #line 91 "..\..\..\Pages\GamePlay.xaml"
            ((System.Windows.Controls.StackPanel)(target)).MouseLeftButtonDown += new System.Windows.Input.MouseButtonEventHandler(this.MyCanvas_PreviewMouseLeftButtonDown);
            
            #line default
            #line hidden
            break;
            }
        }
    }
}

