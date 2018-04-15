using Microsoft.VisualBasic;
using System;
using System.Collections;
using System.Collections.Generic;
using System.Data;
using System.Diagnostics;
using System.Drawing;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using CardLib;
using System.Linq;
using System.Windows.Navigation;

namespace DurakCardDemo
{
    public partial class MainWindow : Window
    {
        private void wndMainScreen_Loaded(object sender, RoutedEventArgs e)
        {
            frmScreen.NavigationUIVisibility = NavigationUIVisibility.Hidden;
            frmScreen.Navigating += OnNavigating;
        }

        private void wndMainScreen_SizeChanged(object sender, SizeChangedEventArgs e)
        {
            //MessageBox.Show(frmScreen.Height + " " + frmScreen.Width);
            //MessageBox.Show(this.RenderSize.Height + " " + this.RenderSize.Width);
            frmScreen.Width = this.RenderSize.Width;
            frmScreen.Height = this.RenderSize.Height;
            
        }
        void OnNavigating(object sender, NavigatingCancelEventArgs e)
        {
            if (e.NavigationMode == NavigationMode.Refresh)
                e.Cancel = true;
        }
    }
}