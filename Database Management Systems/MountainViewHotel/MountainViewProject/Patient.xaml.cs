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
using System.Windows.Shapes;

namespace MountainViewProject
{
    /// <summary>
    /// Interaction logic for Patient.xaml
    /// </summary>
    public partial class Patient : Window
    {
        public Patient()
        {
            InitializeComponent();
        }

        private void button_Copy_Click(object sender, RoutedEventArgs e)
        {
            cnvPatient.Visibility = Visibility.Visible;
            cnvInvoice.Visibility = Visibility.Collapsed;
            btnDelete.Visibility = Visibility.Collapsed;
        }

        private void button_Copy1_Click(object sender, RoutedEventArgs e)
        {
            
            cnvFind.Visibility = Visibility.Visible;
            cnvPatient.Visibility = Visibility.Collapsed;
            cnvInvoice.Visibility = Visibility.Collapsed;
        }

        private void btnFind_Click(object sender, RoutedEventArgs e)
        {
            cnvFind.Visibility = Visibility.Collapsed;
            cnvPatient.Visibility = Visibility.Visible;
            cnvInvoice.Visibility = Visibility.Collapsed;
            btnDelete.Visibility = Visibility.Visible;
            btnAdd.Content = "Update";
        }

        private void button_Copy2_Click(object sender, RoutedEventArgs e)
        {
            cnvInvoice.Visibility = Visibility.Visible;
            cnvPatient.Visibility = Visibility.Collapsed;
            cnvFind.Visibility = Visibility.Collapsed;
        }

        private void button_Copy4_Click(object sender, RoutedEventArgs e)
        {
            MainWindow form = new MainWindow();
            form.Show();
            this.Close();
        }
    }
}
