Public Class frmAssignSeat

    Private Sub btnCancel_Click(sender As Object, e As EventArgs) Handles btnCancel.Click
        Me.Close()
    End Sub

    Private Sub frmAssignSeat_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        'TODO: This line of code loads data into the 'TheatreAccessDataSet.Performances' table. You can move, or remove it, as needed.
        Me.PerformancesTableAdapter.Fill(Me.TheatreAccessDataSet.Performances)

        Dim perfDate As String = frmTheatreSeating.lstPerfDates.GetItemText(frmTheatreSeating.lstPerfDates.SelectedItem)

        lblDate.Text = ""
        lblSeatNumber.Text = ""
        lblPrice.Text = ""
        txtPatron.Text = ""
        SeatingDataSet.Clear()

        lblDate.Text = perfDate
        lblSeatNumber.Text = seatNumber

    End Sub

    Private Sub btnPurchase_Click(sender As Object, e As EventArgs) Handles btnPurchase.Click

        Dim myInsertCommand As OleDb.OleDbCommand = New OleDb.OleDbCommand _
            ("Insert into seating (seat_no, perf_date, patron) values(" & seatNumber & ", '" & lblDate.Text & "', '" & txtPatron.Text & "')", myconnection)

        Try

            If txtPatron.TextLength < 25 Then
                SeatingDataAdapter.Fill(SeatingDataSet)
                SeatingDataAdapter.InsertCommand = myInsertCommand     ' load the Insert command  
                myInsertCommand.ExecuteNonQuery()

            Else
                MessageBox.Show("Your name cannot exceed 25 characters in length! Please try again")
                txtPatron.SelectAll()
                txtPatron.Focus()
            End If

        Catch ex As Exception
            MessageBox.Show("Oopz there was an error! Someone may have already purchased this seat, or we had an error in our database... Please try again!")
            Me.Close()
            Exit Sub
        End Try

        MessageBox.Show("Seat successfully purchased!")
        Me.Close()


    End Sub

    Private Sub PerformancesBindingNavigatorSaveItem_Click(sender As Object, e As EventArgs) Handles PerformancesBindingNavigatorSaveItem.Click
        Me.Validate()
        Me.PerformancesBindingSource.EndEdit()
        Me.TableAdapterManager.UpdateAll(Me.TheatreAccessDataSet)

    End Sub

End Class