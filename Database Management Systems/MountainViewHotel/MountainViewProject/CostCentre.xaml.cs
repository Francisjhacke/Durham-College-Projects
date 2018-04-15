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
    /// Interaction logic for CostCentre.xaml
    /// </summary>
    public partial class CostCentre : Window
    {
        public CostCentre()
        {
            InitializeComponent();
        }

        private void btnCancel_Click(object sender, RoutedEventArgs e)
        {
            MainWindow form = new MainWindow();
            form.Show();
            this.Close();
        }

        private void button_Copy1_Click(object sender, RoutedEventArgs e)
        {
            cnvFind.Visibility = Visibility.Visible;
            cnvPatient.Visibility = Visibility.Collapsed;
        }

        private void btnFind_Click(object sender, RoutedEventArgs e)
        {
            cnvFind.Visibility = Visibility.Collapsed;
            cnvPatient.Visibility = Visibility.Visible;
            btnDelete.Visibility = Visibility.Visible;
            btnAdd.Content = "Update";
        }

        private void button_Copy_Click(object sender, RoutedEventArgs e)
        {
            cnvFind.Visibility = Visibility.Collapsed;
            cnvPatient.Visibility = Visibility.Visible;
            btnDelete.Visibility = Visibility.Collapsed;
            btnAdd.Content = "Add";
        }
    }
}
