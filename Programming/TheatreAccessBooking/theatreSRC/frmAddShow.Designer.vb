<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class frmAddShow
    Inherits System.Windows.Forms.Form

    'Form overrides dispose to clean up the component list.
    <System.Diagnostics.DebuggerNonUserCode()> _
    Protected Overrides Sub Dispose(ByVal disposing As Boolean)
        Try
            If disposing AndAlso components IsNot Nothing Then
                components.Dispose()
            End If
        Finally
            MyBase.Dispose(disposing)
        End Try
    End Sub

    'Required by the Windows Form Designer
    Private components As System.ComponentModel.IContainer

    'NOTE: The following procedure is required by the Windows Form Designer
    'It can be modified using the Windows Form Designer.  
    'Do not modify it using the code editor.
    <System.Diagnostics.DebuggerStepThrough()> _
    Private Sub InitializeComponent()
        Me.lblAddShow = New System.Windows.Forms.Label()
        Me.lblDate = New System.Windows.Forms.Label()
        Me.lblTitle = New System.Windows.Forms.Label()
        Me.lblBasePrice = New System.Windows.Forms.Label()
        Me.txtTitle = New System.Windows.Forms.TextBox()
        Me.txtBasePrice = New System.Windows.Forms.TextBox()
        Me.dtpDate = New System.Windows.Forms.DateTimePicker()
        Me.btnAddShow = New System.Windows.Forms.Button()
        Me.btnReturn = New System.Windows.Forms.Button()
        Me.SuspendLayout()
        '
        'lblAddShow
        '
        Me.lblAddShow.AutoSize = True
        Me.lblAddShow.Font = New System.Drawing.Font("Microsoft Sans Serif", 13.8!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.lblAddShow.Location = New System.Drawing.Point(35, 27)
        Me.lblAddShow.Name = "lblAddShow"
        Me.lblAddShow.Size = New System.Drawing.Size(275, 29)
        Me.lblAddShow.TabIndex = 0
        Me.lblAddShow.Text = "Add New Performance"
        '
        'lblDate
        '
        Me.lblDate.AutoSize = True
        Me.lblDate.Location = New System.Drawing.Point(75, 85)
        Me.lblDate.Name = "lblDate"
        Me.lblDate.Size = New System.Drawing.Size(42, 17)
        Me.lblDate.TabIndex = 1
        Me.lblDate.Text = "Date:"
        '
        'lblTitle
        '
        Me.lblTitle.AutoSize = True
        Me.lblTitle.Location = New System.Drawing.Point(78, 123)
        Me.lblTitle.Name = "lblTitle"
        Me.lblTitle.Size = New System.Drawing.Size(39, 17)
        Me.lblTitle.TabIndex = 2
        Me.lblTitle.Text = "Title:"
        '
        'lblBasePrice
        '
        Me.lblBasePrice.AutoSize = True
        Me.lblBasePrice.Location = New System.Drawing.Point(37, 165)
        Me.lblBasePrice.Name = "lblBasePrice"
        Me.lblBasePrice.Size = New System.Drawing.Size(80, 17)
        Me.lblBasePrice.TabIndex = 3
        Me.lblBasePrice.Text = "Base Price:"
        '
        'txtTitle
        '
        Me.txtTitle.Location = New System.Drawing.Point(148, 123)
        Me.txtTitle.MaxLength = 50
        Me.txtTitle.Name = "txtTitle"
        Me.txtTitle.Size = New System.Drawing.Size(111, 22)
        Me.txtTitle.TabIndex = 5
        '
        'txtBasePrice
        '
        Me.txtBasePrice.Location = New System.Drawing.Point(148, 165)
        Me.txtBasePrice.Name = "txtBasePrice"
        Me.txtBasePrice.Size = New System.Drawing.Size(111, 22)
        Me.txtBasePrice.TabIndex = 6
        '
        'dtpDate
        '
        Me.dtpDate.Format = System.Windows.Forms.DateTimePickerFormat.Custom
        Me.dtpDate.Location = New System.Drawing.Point(148, 85)
        Me.dtpDate.Name = "dtpDate"
        Me.dtpDate.Size = New System.Drawing.Size(111, 22)
        Me.dtpDate.TabIndex = 7
        '
        'btnAddShow
        '
        Me.btnAddShow.Location = New System.Drawing.Point(78, 208)
        Me.btnAddShow.Name = "btnAddShow"
        Me.btnAddShow.Size = New System.Drawing.Size(86, 26)
        Me.btnAddShow.TabIndex = 8
        Me.btnAddShow.Text = "Add Show"
        Me.btnAddShow.UseVisualStyleBackColor = True
        '
        'btnReturn
        '
        Me.btnReturn.DialogResult = System.Windows.Forms.DialogResult.Cancel
        Me.btnReturn.Location = New System.Drawing.Point(173, 208)
        Me.btnReturn.Name = "btnReturn"
        Me.btnReturn.Size = New System.Drawing.Size(86, 26)
        Me.btnReturn.TabIndex = 9
        Me.btnReturn.Text = "Return"
        Me.btnReturn.UseVisualStyleBackColor = True
        '
        'frmAddShow
        '
        Me.AcceptButton = Me.btnAddShow
        Me.AutoScaleDimensions = New System.Drawing.SizeF(8.0!, 16.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.CancelButton = Me.btnReturn
        Me.ClientSize = New System.Drawing.Size(362, 246)
        Me.Controls.Add(Me.btnReturn)
        Me.Controls.Add(Me.btnAddShow)
        Me.Controls.Add(Me.dtpDate)
        Me.Controls.Add(Me.txtBasePrice)
        Me.Controls.Add(Me.txtTitle)
        Me.Controls.Add(Me.lblBasePrice)
        Me.Controls.Add(Me.lblTitle)
        Me.Controls.Add(Me.lblDate)
        Me.Controls.Add(Me.lblAddShow)
        Me.Name = "frmAddShow"
        Me.Text = "Add Show"
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents lblAddShow As System.Windows.Forms.Label
    Friend WithEvents lblDate As System.Windows.Forms.Label
    Friend WithEvents lblTitle As System.Windows.Forms.Label
    Friend WithEvents lblBasePrice As System.Windows.Forms.Label
    Friend WithEvents txtTitle As System.Windows.Forms.TextBox
    Friend WithEvents txtBasePrice As System.Windows.Forms.TextBox
    Friend WithEvents dtpDate As System.Windows.Forms.DateTimePicker
    Friend WithEvents btnAddShow As System.Windows.Forms.Button
    Friend WithEvents btnReturn As System.Windows.Forms.Button
End Class
