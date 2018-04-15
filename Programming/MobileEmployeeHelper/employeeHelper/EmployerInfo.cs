using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

using Android.App;
using Android.Content;
using Android.OS;
using Android.Runtime;
using Android.Views;
using Android.Widget;

namespace employeeHelper
{
    [Activity(Label = "EmployerInfo")]
    public class EmployerInfo : Activity
    {
        protected override void OnCreate(Bundle savedInstanceState)
        {
            base.OnCreate(savedInstanceState);

            SetContentView(Resource.Layout.EmployerInfo);

            Button btnReturn = FindViewById<Button>(Resource.Id.btnReturn);

            btnReturn.Click += delegate
            {
                StartActivity(typeof(MainActivity));
            };

            EditText txtPhone = FindViewById<EditText>(Resource.Id.txtPhone);
            Button btnCall = FindViewById<Button>(Resource.Id.btnCall);

            string phoneNumber = string.Empty;

            btnCall.Click += (object sender, EventArgs e) =>
            {
                phoneNumber = txtPhone.Text;
                // On "Call" button click, try to dial phone number.
                var callDialog = new AlertDialog.Builder(this);
                callDialog.SetMessage("Call " + phoneNumber + "?");
                callDialog.SetNeutralButton("Call", delegate
                {
                    // Create intent to dial phone
                    var callIntent = new Intent(Intent.ActionCall);
                    callIntent.SetData(Android.Net.Uri.Parse("tel:" +
                    phoneNumber));
                    StartActivity(callIntent);
                });
                callDialog.SetNegativeButton("Cancel", delegate { });
                // Show the alert dialog to the user and wait for response.
                callDialog.Show();
            };

        }
    }
}