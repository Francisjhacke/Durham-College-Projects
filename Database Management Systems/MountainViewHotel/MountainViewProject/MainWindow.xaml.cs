using System;
using System.Collections.Generic;
using System.IO;
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

namespace MountainViewProject
{
    /// <summary>
    /// Interaction logic for MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {
        public MainWindow()
        {
            InitializeComponent();
        }

        private void button_Copy_Click(object sender, RoutedEventArgs e)
        {
            Patient form = new Patient();
            form.Show();
            this.Close();
        }

        private void button_Copy1_Click(object sender, RoutedEventArgs e)
        {
            Physician form = new Physician();
            form.Show();
            this.Close();
        }

        private void button_Copy2_Click(object sender, RoutedEventArgs e)
        {
            Rooms form = new Rooms();
            form.Show();
            this.Close();
        }

        private void button_Copy3_Click(object sender, RoutedEventArgs e)
        {
            Items form = new Items();
            form.Show();
            this.Close();
        }

        private void button_Copy4_Click(object sender, RoutedEventArgs e)
        {
            CostCentre form = new CostCentre();
            form.Show();
            this.Close();
        }

        private void button_Copy5_Click(object sender, RoutedEventArgs e)
        {
            Transaction form = new Transaction();
            form.Show();
            this.Close();
        }

        private void button_Help_Click(object sender, RoutedEventArgs e)
        {
            try
            {
                System.Diagnostics.Process process = new System.Diagnostics.Process();
                string path = AppDomain.CurrentDomain.BaseDirectory + @"/user_documentation.pdf";
                Uri pdf = new Uri(path, UriKind.RelativeOrAbsolute);
                process.StartInfo.FileName = pdf.LocalPath;
                process.Start();
                process.WaitForExit();
            }
            catch (Exception error)
            {
                MessageBox.Show("Could not open the file.", "Error", MessageBoxButton.OK, MessageBoxImage.Warning);
            }
        }
    }
}
