Public Class frmAddShow

    Private Sub btnReturn_Click(sender As Object, e As EventArgs) Handles btnReturn.Click
        Me.Close()
    End Sub

    Private Sub btnAddShow_Click(sender As Object, e As EventArgs) Handles btnAddShow.Click
        Dim failed As Boolean = False


        Dim myInsertCommand As OleDb.OleDbCommand = New OleDb.OleDbCommand _
    ("Insert into Performances (perf_date, show_title, base_ticket_price) values('" & dtpDate.Text & "', '" & txtTitle.Text & "', " & txtBasePrice.Text & ")", myconnection)

        ' Validate users input before storing in the database
        ' Issue valid errors to the user if they have input incorrect values
        If dtpDate.Text = "" Then
            MessageBox.Show("Please enter a date")
            dtpDate.Focus()
            failed = True
        End If

        If txtTitle.Text = "" Then
            MessageBox.Show("You must enter a title!")
            txtTitle.Focus()
            failed = True
        End If

        If txtBasePrice.Text = "" Then
            MessageBox.Show("You must enter a base price!")
            txtBasePrice.Focus()
            failed = True

        ElseIf Not IsNumeric(txtBasePrice.Text) Then
            MessageBox.Show("The base price must be a numeric value!")
            txtBasePrice.SelectAll()
            txtBasePrice.Focus()
            failed = True
        End If

        If failed = True Then
            Exit Sub

            ' All validation has passed, insert the record into the database
        Else
            Try
                PerformancesDataAdapter.Fill(PerformancesDataSet)
                PerformancesDataAdapter.InsertCommand = myInsertCommand
                myInsertCommand.ExecuteNonQuery()
                MessageBox.Show("Show successfully created!")
                PerformancesDataSet.Clear()
                PerformancesDataAdapter.Fill(PerformancesDataSet)

                frmTheatreSeating.lstPerfDates.DataSource = PerformancesDataSet.Tables(0)
                Me.Close()

            Catch ex As Exception
                MessageBox.Show("Oops! Something went wrong! Please try again.")
            End Try
        End If

    End Sub

    Private Sub frmAddShow_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        PerformancesDataSet.Clear()
        txtTitle.Focus()
        txtTitle.Text = ""
        txtBasePrice.Text = ""
    End Sub
End Class