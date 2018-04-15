Module modDataConnections

    Friend myconnection As New OleDb.OleDbConnection   'Create connection
    Friend SeatingDataAdapter As New OleDb.OleDbDataAdapter("select * from seating", myconnection) 'Create data adapter
    Friend SeatingDataSet As New DataSet    ' Create dataset

    Friend PerformancesDataAdapter As New OleDb.OleDbDataAdapter("select * from performances", myconnection)
    Friend PerformancesDataSet As New DataSet

    Public seatNumber As Integer

End Module
