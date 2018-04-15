Public Class frmTheatreSeating
    '-------------'
    ' DECLARATIONS' 
    '-------------'
    Dim arrLabelSeats(20) As Label ' The labels array that will be used to keep track of all the seats on the form


    Private Sub btnExit_Click(sender As Object, e As EventArgs) Handles btnExit.Click
        Me.Close()
    End Sub

    Private Sub frmTheatreSeating_Load(sender As Object, e As EventArgs) Handles MyBase.Load

        ' Connect the database
        myconnection.ConnectionString = "Provider=Microsoft.ACE.OLEDB.12.0;Data Source=|DataDirectory|\TheatreAccess.accdb;Persist Security Info=False"
        Try
            ' Open the connection to the database
            myconnection.Open()

            ' Fill the datasets
            SeatingDataAdapter.Fill(SeatingDataSet)
            PerformancesDataAdapter.Fill(PerformancesDataSet)

            ' Bind the data source to the list box
            lstPerfDates.DataSource = PerformancesDataSet.Tables(0)
            lstPerfDates.DisplayMember = "perf_date"

        Catch ex As Exception
            MessageBox.Show("Could not open connection!")
        End Try

        ' Select the first item in the list box as default
        lstPerfDates.Select()

        ' Populate the arrLabelSeats array with the labels on the form
        ' Populate the tooltips for the labels with the seat number
        ' Add the event handlers for each label (enter and leave mouse events)
        For labelCounter As Integer = 1 To UBound(arrLabelSeats)
            ' Populate the array
            arrLabelSeats(labelCounter) = Controls("lblSeat" & labelCounter.ToString())

            ' Populate the tooltips with seat info
            tipSeatInfo.SetToolTip(arrLabelSeats(labelCounter), "Seat " & labelCounter.ToString())

            ' Populate tags properties for seats
            arrLabelSeats(labelCounter).Tag = labelCounter.ToString()

            ' Add the Mouse Enter handler for the array of labels
            AddHandler arrLabelSeats(labelCounter).MouseEnter, AddressOf lblSeats_MouseEnter
            AddHandler arrLabelSeats(labelCounter).MouseLeave, AddressOf lblSeats_MouseLeave
            AddHandler arrLabelSeats(labelCounter).Click, AddressOf lblSeat_Click
        Next

    End Sub

    Private Sub btnAvailable_Click(sender As Object, e As EventArgs) Handles btnAvailable.Click

        Dim perfDate As String = lstPerfDates.GetItemText(lstPerfDates.SelectedItem)
        ' Loop through the labels array and display with seats are available and unavailable
        For seatCount As Integer = 1 To UBound(arrLabelSeats)
            SeatingDataAdapter.SelectCommand.CommandText = "select * from seating where seat_no = " & seatCount & " AND perf_date= '" & perfDate & "'"
            SeatingDataSet.Clear()
            SeatingDataAdapter.Fill(SeatingDataSet)

            ' If a record was found at the position then mark down the patrons name
            If SeatingDataSet.Tables(0).Rows.Count = 1 Then
                arrLabelSeats(seatCount).BackColor = Color.Red
                tipSeatInfo.SetToolTip(arrLabelSeats(seatCount), SeatingDataSet.Tables(0).Rows(0)("patron"))

                ' If a record wasn't found at the position then mark it was available
            Else
                arrLabelSeats(seatCount).BackColor = Color.Green
                tipSeatInfo.SetToolTip(arrLabelSeats(seatCount), "Available")
            End If
        Next

        ' Replace this button with the reset button
        btnReset.Visible = True
        btnAvailable.Visible = False


    End Sub

    Private Sub btnReset_Click(sender As Object, e As EventArgs) Handles btnReset.Click, btnReset.MouseLeave

        ' Replace this button with the available button
        btnAvailable.Visible = True
        btnReset.Visible = False

        SeatingDataSet.Clear()
        For seatCount As Integer = 1 To UBound(arrLabelSeats)
            tipSeatInfo.SetToolTip(arrLabelSeats(seatCount), "Seat " & seatCount.ToString())
            arrLabelSeats(seatCount).BackColor = Color.White
        Next

    End Sub

    Private Sub lblSeats_MouseEnter(sender As Object, e As EventArgs)

        Dim seatNumber = CInt(CType(sender, Label).Tag)
        Dim perfDate As String = lstPerfDates.GetItemText(lstPerfDates.SelectedItem)

        SeatingDataAdapter.SelectCommand.CommandText = "select * from seating where seat_no = " & seatNumber & " AND perf_date= '" & perfDate.ToString & "'"
        SeatingDataSet.Clear()
        SeatingDataAdapter.Fill(SeatingDataSet)

        ' If a record was found at the position then mark down the patrons name
        If SeatingDataSet.Tables(0).Rows.Count = 1 Then
            arrLabelSeats(seatNumber).BackColor = Color.Red
            tipSeatInfo.SetToolTip(arrLabelSeats(seatNumber), SeatingDataSet.Tables(0).Rows(0)("patron"))

            ' If a record wasn't found at the position then mark it was available
        Else
            arrLabelSeats(seatNumber).BackColor = Color.Green
            tipSeatInfo.SetToolTip(arrLabelSeats(seatNumber), "Available")
        End If


    End Sub

    Private Sub lblSeats_MouseLeave(sender As Object, e As EventArgs)

        ' Loop through the labels array and reset them
        SeatingDataSet.Clear()
        For seatCount As Integer = 1 To UBound(arrLabelSeats)
            tipSeatInfo.SetToolTip(arrLabelSeats(seatCount), "Seat " & seatCount.ToString())
            arrLabelSeats(seatCount).BackColor = Color.White
        Next

    End Sub

    Private Sub btnAddShow_Click(sender As Object, e As EventArgs) Handles btnAddShow.Click
        frmAddShow.ShowDialog()
    End Sub

    Private Sub lblSeat_Click(sender As Object, e As EventArgs)

        If Not SeatingDataSet.Tables(0).Rows.Count = 1 Then
            seatNumber = CInt(CType(sender, Label).Tag)
            frmAssignSeat.ShowDialog()
        Else
            Exit Sub
        End If

    End Sub

    Private Sub lstPerfDates_SelectedIndexChanged(sender As Object, e As EventArgs) Handles lstPerfDates.SelectedIndexChanged
        Try
            lblStage.Text = PerformancesDataSet.Tables(0).Rows(lstPerfDates.SelectedIndex)("show_title").ToString
        Catch ex As Exception
            Exit Sub
        End Try
    End Sub
End Class
