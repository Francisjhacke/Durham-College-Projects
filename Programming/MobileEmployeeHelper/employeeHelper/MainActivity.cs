using System;
using Android.App;
using Android.Content;
using Android.Runtime;
using Android.Views;
using Android.Widget;
using Android.OS;

namespace employeeHelper
{
    [Activity(Label = "employeeHelper", MainLauncher = true, Icon = "@drawable/icon")]
    public class MainActivity : Activity
    {
        protected override void OnCreate(Bundle bundle)
        {
            base.OnCreate(bundle);

            // Set our view from the "main" layout resource
            SetContentView(Resource.Layout.Main);

            Button btnSchedule = FindViewById<Button>(Resource.Id.btnSchedule);
            Button btnEmployerInfo = FindViewById<Button>(Resource.Id.btnEmployerInfo);
            Button btnUpdate = FindViewById<Button>(Resource.Id.btnUpdate);
            EditText txtHours = FindViewById<EditText>(Resource.Id.editText1);
            EditText txtWage = FindViewById<EditText>(Resource.Id.editText2);
            TextView lblTotalPay = FindViewById<TextView>(Resource.Id.lblTotalPay);

            btnUpdate.Click += delegate {
                lblTotalPay.Text = "Total pay this week: $";
                decimal hours = Convert.ToDecimal(txtHours.Text);
                decimal wage = Convert.ToDecimal(txtWage.Text);
                decimal totalPay = hours * wage;

                lblTotalPay.Text += Convert.ToString(totalPay);
            };

            btnSchedule.Click += delegate {
                StartActivity(typeof(Schedule));
            };

            btnEmployerInfo.Click += delegate
            {
                StartActivity(typeof(EmployerInfo));
            };
        }

    }
}

