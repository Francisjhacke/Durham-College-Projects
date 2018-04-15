<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class frmAssignSeat
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
        Me.components = New System.ComponentModel.Container()
        Dim resources As System.ComponentModel.ComponentResourceManager = New System.ComponentModel.ComponentResourceManager(GetType(frmAssignSeat))
        Me.lblBuySeat = New System.Windows.Forms.Label()
        Me.lblPatronName = New System.Windows.Forms.Label()
        Me.lblDatePrompt = New System.Windows.Forms.Label()
        Me.lblSeatPrompt = New System.Windows.Forms.Label()
        Me.lblPricePrompt = New System.Windows.Forms.Label()
        Me.txtPatron = New System.Windows.Forms.TextBox()
        Me.lblDate = New System.Windows.Forms.Label()
        Me.lblSeatNumber = New System.Windows.Forms.Label()
        Me.btnPurchase = New System.Windows.Forms.Button()
        Me.btnCancel = New System.Windows.Forms.Button()
        Me.TheatreAccessDataSet = New Lab5.TheatreAccessDataSet()
        Me.PerformancesBindingSource = New System.Windows.Forms.BindingSource(Me.components)
        Me.PerformancesTableAdapter = New Lab5.TheatreAccessDataSetTableAdapters.PerformancesTableAdapter()
        Me.TableAdapterManager = New Lab5.TheatreAccessDataSetTableAdapters.TableAdapterManager()
        Me.PerformancesBindingNavigator = New System.Windows.Forms.BindingNavigator(Me.components)
        Me.BindingNavigatorAddNewItem = New System.Windows.Forms.ToolStripButton()
        Me.BindingNavigatorCountItem = New System.Windows.Forms.ToolStripLabel()
        Me.BindingNavigatorDeleteItem = New System.Windows.Forms.ToolStripButton()
        Me.BindingNavigatorMoveFirstItem = New System.Windows.Forms.ToolStripButton()
        Me.BindingNavigatorMovePreviousItem = New System.Windows.Forms.ToolStripButton()
        Me.BindingNavigatorSeparator = New System.Windows.Forms.ToolStripSeparator()
        Me.BindingNavigatorPositionItem = New System.Windows.Forms.ToolStripTextBox()
        Me.BindingNavigatorSeparator1 = New System.Windows.Forms.ToolStripSeparator()
        Me.BindingNavigatorMoveNextItem = New System.Windows.Forms.ToolStripButton()
        Me.BindingNavigatorMoveLastItem = New System.Windows.Forms.ToolStripButton()
        Me.BindingNavigatorSeparator2 = New System.Windows.Forms.ToolStripSeparator()
        Me.PerformancesBindingNavigatorSaveItem = New System.Windows.Forms.ToolStripButton()
        Me.lblPrice = New System.Windows.Forms.Label()
        CType(Me.TheatreAccessDataSet, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.PerformancesBindingSource, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.PerformancesBindingNavigator, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.PerformancesBindingNavigator.SuspendLayout()
        Me.SuspendLayout()
        '
        'lblBuySeat
        '
        Me.lblBuySeat.AutoSize = True
        Me.lblBuySeat.Font = New System.Drawing.Font("Microsoft Sans Serif", 13.8!, System.Drawing.FontStyle.Bold, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.lblBuySeat.Location = New System.Drawing.Point(62, 22)
        Me.lblBuySeat.Name = "lblBuySeat"
        Me.lblBuySeat.Size = New System.Drawing.Size(199, 29)
        Me.lblBuySeat.TabIndex = 0
        Me.lblBuySeat.Text = "Purchase a seat"
        '
        'lblPatronName
        '
        Me.lblPatronName.AutoSize = True
        Me.lblPatronName.Location = New System.Drawing.Point(34, 83)
        Me.lblPatronName.Name = "lblPatronName"
        Me.lblPatronName.Size = New System.Drawing.Size(95, 17)
        Me.lblPatronName.TabIndex = 1
        Me.lblPatronName.Text = "Patron Name:"
        '
        'lblDatePrompt
        '
        Me.lblDatePrompt.AutoSize = True
        Me.lblDatePrompt.Location = New System.Drawing.Point(87, 121)
        Me.lblDatePrompt.Name = "lblDatePrompt"
        Me.lblDatePrompt.Size = New System.Drawing.Size(42, 17)
        Me.lblDatePrompt.TabIndex = 2
        Me.lblDatePrompt.Text = "Date:"
        '
        'lblSeatPrompt
        '
        Me.lblSeatPrompt.AutoSize = True
        Me.lblSeatPrompt.Location = New System.Drawing.Point(88, 158)
        Me.lblSeatPrompt.Name = "lblSeatPrompt"
        Me.lblSeatPrompt.Size = New System.Drawing.Size(41, 17)
        Me.lblSeatPrompt.TabIndex = 3
        Me.lblSeatPrompt.Text = "Seat:"
        '
        'lblPricePrompt
        '
        Me.lblPricePrompt.AutoSize = True
        Me.lblPricePrompt.Location = New System.Drawing.Point(85, 201)
        Me.lblPricePrompt.Name = "lblPricePrompt"
        Me.lblPricePrompt.Size = New System.Drawing.Size(44, 17)
        Me.lblPricePrompt.TabIndex = 4
        Me.lblPricePrompt.Text = "Price:"
        '
        'txtPatron
        '
        Me.txtPatron.Location = New System.Drawing.Point(147, 83)
        Me.txtPatron.Name = "txtPatron"
        Me.txtPatron.Size = New System.Drawing.Size(100, 22)
        Me.txtPatron.TabIndex = 5
        '
        'lblDate
        '
        Me.lblDate.BorderStyle = System.Windows.Forms.BorderStyle.Fixed3D
        Me.lblDate.Location = New System.Drawing.Point(147, 121)
        Me.lblDate.Name = "lblDate"
        Me.lblDate.Size = New System.Drawing.Size(100, 23)
        Me.lblDate.TabIndex = 6
        '
        'lblSeatNumber
        '
        Me.lblSeatNumber.BorderStyle = System.Windows.Forms.BorderStyle.Fixed3D
        Me.lblSeatNumber.Location = New System.Drawing.Point(147, 158)
        Me.lblSeatNumber.Name = "lblSeatNumber"
        Me.lblSeatNumber.Size = New System.Drawing.Size(100, 23)
        Me.lblSeatNumber.TabIndex = 7
        '
        'btnPurchase
        '
        Me.btnPurchase.Location = New System.Drawing.Point(67, 249)
        Me.btnPurchase.Name = "btnPurchase"
        Me.btnPurchase.Size = New System.Drawing.Size(82, 23)
        Me.btnPurchase.TabIndex = 9
        Me.btnPurchase.Text = "Purchase"
        Me.btnPurchase.UseVisualStyleBackColor = True
        '
        'btnCancel
        '
        Me.btnCancel.Location = New System.Drawing.Point(186, 249)
        Me.btnCancel.Name = "btnCancel"
        Me.btnCancel.Size = New System.Drawing.Size(83, 23)
        Me.btnCancel.TabIndex = 10
        Me.btnCancel.Text = "Cancel"
        Me.btnCancel.UseVisualStyleBackColor = True
        '
        'TheatreAccessDataSet
        '
        Me.TheatreAccessDataSet.DataSetName = "TheatreAccessDataSet"
        Me.TheatreAccessDataSet.SchemaSerializationMode = System.Data.SchemaSerializationMode.IncludeSchema
        '
        'PerformancesBindingSource
        '
        Me.PerformancesBindingSource.DataMember = "Performances"
        Me.PerformancesBindingSource.DataSource = Me.TheatreAccessDataSet
        '
        'PerformancesTableAdapter
        '
        Me.PerformancesTableAdapter.ClearBeforeFill = True
        '
        'TableAdapterManager
        '
        Me.TableAdapterManager.BackupDataSetBeforeUpdate = False
        Me.TableAdapterManager.PerformancesTableAdapter = Me.PerformancesTableAdapter
        Me.TableAdapterManager.seatingTableAdapter = Nothing
        Me.TableAdapterManager.UpdateOrder = Lab5.TheatreAccessDataSetTableAdapters.TableAdapterManager.UpdateOrderOption.InsertUpdateDelete
        '
        'PerformancesBindingNavigator
        '
        Me.PerformancesBindingNavigator.AddNewItem = Me.BindingNavigatorAddNewItem
        Me.PerformancesBindingNavigator.BindingSource = Me.PerformancesBindingSource
        Me.PerformancesBindingNavigator.CountItem = Me.BindingNavigatorCountItem
        Me.PerformancesBindingNavigator.DeleteItem = Me.BindingNavigatorDeleteItem
        Me.PerformancesBindingNavigator.Items.AddRange(New System.Windows.Forms.ToolStripItem() {Me.BindingNavigatorMoveFirstItem, Me.BindingNavigatorMovePreviousItem, Me.BindingNavigatorSeparator, Me.BindingNavigatorPositionItem, Me.BindingNavigatorCountItem, Me.BindingNavigatorSeparator1, Me.BindingNavigatorMoveNextItem, Me.BindingNavigatorMoveLastItem, Me.BindingNavigatorSeparator2, Me.BindingNavigatorAddNewItem, Me.BindingNavigatorDeleteItem, Me.PerformancesBindingNavigatorSaveItem})
        Me.PerformancesBindingNavigator.Location = New System.Drawing.Point(0, 0)
        Me.PerformancesBindingNavigator.MoveFirstItem = Me.BindingNavigatorMoveFirstItem
        Me.PerformancesBindingNavigator.MoveLastItem = Me.BindingNavigatorMoveLastItem
        Me.PerformancesBindingNavigator.MoveNextItem = Me.BindingNavigatorMoveNextItem
        Me.PerformancesBindingNavigator.MovePreviousItem = Me.BindingNavigatorMovePreviousItem
        Me.PerformancesBindingNavigator.Name = "PerformancesBindingNavigator"
        Me.PerformancesBindingNavigator.PositionItem = Me.BindingNavigatorPositionItem
        Me.PerformancesBindingNavigator.Size = New System.Drawing.Size(506, 27)
        Me.PerformancesBindingNavigator.TabIndex = 11
        Me.PerformancesBindingNavigator.Text = "BindingNavigator1"
        Me.PerformancesBindingNavigator.Visible = False
        '
        'BindingNavigatorAddNewItem
        '
        Me.BindingNavigatorAddNewItem.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Image
        Me.BindingNavigatorAddNewItem.Image = CType(resources.GetObject("BindingNavigatorAddNewItem.Image"), System.Drawing.Image)
        Me.BindingNavigatorAddNewItem.Name = "BindingNavigatorAddNewItem"
        Me.BindingNavigatorAddNewItem.RightToLeftAutoMirrorImage = True
        Me.BindingNavigatorAddNewItem.Size = New System.Drawing.Size(23, 24)
        Me.BindingNavigatorAddNewItem.Text = "Add new"
        '
        'BindingNavigatorCountItem
        '
        Me.BindingNavigatorCountItem.Name = "BindingNavigatorCountItem"
        Me.BindingNavigatorCountItem.Size = New System.Drawing.Size(45, 24)
        Me.BindingNavigatorCountItem.Text = "of {0}"
        Me.BindingNavigatorCountItem.ToolTipText = "Total number of items"
        '
        'BindingNavigatorDeleteItem
        '
        Me.BindingNavigatorDeleteItem.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Image
        Me.BindingNavigatorDeleteItem.Image = CType(resources.GetObject("BindingNavigatorDeleteItem.Image"), System.Drawing.Image)
        Me.BindingNavigatorDeleteItem.Name = "BindingNavigatorDeleteItem"
        Me.BindingNavigatorDeleteItem.RightToLeftAutoMirrorImage = True
        Me.BindingNavigatorDeleteItem.Size = New System.Drawing.Size(23, 24)
        Me.BindingNavigatorDeleteItem.Text = "Delete"
        '
        'BindingNavigatorMoveFirstItem
        '
        Me.BindingNavigatorMoveFirstItem.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Image
        Me.BindingNavigatorMoveFirstItem.Image = CType(resources.GetObject("BindingNavigatorMoveFirstItem.Image"), System.Drawing.Image)
        Me.BindingNavigatorMoveFirstItem.Name = "BindingNavigatorMoveFirstItem"
        Me.BindingNavigatorMoveFirstItem.RightToLeftAutoMirrorImage = True
        Me.BindingNavigatorMoveFirstItem.Size = New System.Drawing.Size(23, 24)
        Me.BindingNavigatorMoveFirstItem.Text = "Move first"
        '
        'BindingNavigatorMovePreviousItem
        '
        Me.BindingNavigatorMovePreviousItem.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Image
        Me.BindingNavigatorMovePreviousItem.Image = CType(resources.GetObject("BindingNavigatorMovePreviousItem.Image"), System.Drawing.Image)
        Me.BindingNavigatorMovePreviousItem.Name = "BindingNavigatorMovePreviousItem"
        Me.BindingNavigatorMovePreviousItem.RightToLeftAutoMirrorImage = True
        Me.BindingNavigatorMovePreviousItem.Size = New System.Drawing.Size(23, 24)
        Me.BindingNavigatorMovePreviousItem.Text = "Move previous"
        '
        'BindingNavigatorSeparator
        '
        Me.BindingNavigatorSeparator.Name = "BindingNavigatorSeparator"
        Me.BindingNavigatorSeparator.Size = New System.Drawing.Size(6, 27)
        '
        'BindingNavigatorPositionItem
        '
        Me.BindingNavigatorPositionItem.AccessibleName = "Position"
        Me.BindingNavigatorPositionItem.AutoSize = False
        Me.BindingNavigatorPositionItem.Name = "BindingNavigatorPositionItem"
        Me.BindingNavigatorPositionItem.Size = New System.Drawing.Size(50, 27)
        Me.BindingNavigatorPositionItem.Text = "0"
        Me.BindingNavigatorPositionItem.ToolTipText = "Current position"
        '
        'BindingNavigatorSeparator1
        '
        Me.BindingNavigatorSeparator1.Name = "BindingNavigatorSeparator1"
        Me.BindingNavigatorSeparator1.Size = New System.Drawing.Size(6, 27)
        '
        'BindingNavigatorMoveNextItem
        '
        Me.BindingNavigatorMoveNextItem.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Image
        Me.BindingNavigatorMoveNextItem.Image = CType(resources.GetObject("BindingNavigatorMoveNextItem.Image"), System.Drawing.Image)
        Me.BindingNavigatorMoveNextItem.Name = "BindingNavigatorMoveNextItem"
        Me.BindingNavigatorMoveNextItem.RightToLeftAutoMirrorImage = True
        Me.BindingNavigatorMoveNextItem.Size = New System.Drawing.Size(23, 24)
        Me.BindingNavigatorMoveNextItem.Text = "Move next"
        '
        'BindingNavigatorMoveLastItem
        '
        Me.BindingNavigatorMoveLastItem.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Image
        Me.BindingNavigatorMoveLastItem.Image = CType(resources.GetObject("BindingNavigatorMoveLastItem.Image"), System.Drawing.Image)
        Me.BindingNavigatorMoveLastItem.Name = "BindingNavigatorMoveLastItem"
        Me.BindingNavigatorMoveLastItem.RightToLeftAutoMirrorImage = True
        Me.BindingNavigatorMoveLastItem.Size = New System.Drawing.Size(23, 24)
        Me.BindingNavigatorMoveLastItem.Text = "Move last"
        '
        'BindingNavigatorSeparator2
        '
        Me.BindingNavigatorSeparator2.Name = "BindingNavigatorSeparator2"
        Me.BindingNavigatorSeparator2.Size = New System.Drawing.Size(6, 27)
        '
        'PerformancesBindingNavigatorSaveItem
        '
        Me.PerformancesBindingNavigatorSaveItem.DisplayStyle = System.Windows.Forms.ToolStripItemDisplayStyle.Image
        Me.PerformancesBindingNavigatorSaveItem.Image = CType(resources.GetObject("PerformancesBindingNavigatorSaveItem.Image"), System.Drawing.Image)
        Me.PerformancesBindingNavigatorSaveItem.Name = "PerformancesBindingNavigatorSaveItem"
        Me.PerformancesBindingNavigatorSaveItem.Size = New System.Drawing.Size(23, 24)
        Me.PerformancesBindingNavigatorSaveItem.Text = "Save Data"
        '
        'lblPrice
        '
        Me.lblPrice.BorderStyle = System.Windows.Forms.BorderStyle.Fixed3D
        Me.lblPrice.DataBindings.Add(New System.Windows.Forms.Binding("Text", Me.PerformancesBindingSource, "base_ticket_price", True))
        Me.lblPrice.Location = New System.Drawing.Point(144, 201)
        Me.lblPrice.Name = "lblPrice"
        Me.lblPrice.Size = New System.Drawing.Size(103, 23)
        Me.lblPrice.TabIndex = 13
        '
        'frmAssignSeat
        '
        Me.AcceptButton = Me.btnPurchase
        Me.AutoScaleDimensions = New System.Drawing.SizeF(8.0!, 16.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.CancelButton = Me.btnCancel
        Me.ClientSize = New System.Drawing.Size(341, 291)
        Me.Controls.Add(Me.lblPrice)
        Me.Controls.Add(Me.PerformancesBindingNavigator)
        Me.Controls.Add(Me.btnCancel)
        Me.Controls.Add(Me.btnPurchase)
        Me.Controls.Add(Me.lblSeatNumber)
        Me.Controls.Add(Me.lblDate)
        Me.Controls.Add(Me.txtPatron)
        Me.Controls.Add(Me.lblPricePrompt)
        Me.Controls.Add(Me.lblSeatPrompt)
        Me.Controls.Add(Me.lblDatePrompt)
        Me.Controls.Add(Me.lblPatronName)
        Me.Controls.Add(Me.lblBuySeat)
        Me.Name = "frmAssignSeat"
        Me.Text = "Purchase a seat"
        CType(Me.TheatreAccessDataSet, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.PerformancesBindingSource, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.PerformancesBindingNavigator, System.ComponentModel.ISupportInitialize).EndInit()
        Me.PerformancesBindingNavigator.ResumeLayout(False)
        Me.PerformancesBindingNavigator.PerformLayout()
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents lblBuySeat As System.Windows.Forms.Label
    Friend WithEvents lblPatronName As System.Windows.Forms.Label
    Friend WithEvents lblDatePrompt As System.Windows.Forms.Label
    Friend WithEvents lblSeatPrompt As System.Windows.Forms.Label
    Friend WithEvents lblPricePrompt As System.Windows.Forms.Label
    Friend WithEvents txtPatron As System.Windows.Forms.TextBox
    Friend WithEvents lblDate As System.Windows.Forms.Label
    Friend WithEvents lblSeatNumber As System.Windows.Forms.Label
    Friend WithEvents btnPurchase As System.Windows.Forms.Button
    Friend WithEvents btnCancel As System.Windows.Forms.Button
    Friend WithEvents TheatreAccessDataSet As Lab5.TheatreAccessDataSet
    Friend WithEvents PerformancesBindingSource As System.Windows.Forms.BindingSource
    Friend WithEvents PerformancesTableAdapter As Lab5.TheatreAccessDataSetTableAdapters.PerformancesTableAdapter
    Friend WithEvents TableAdapterManager As Lab5.TheatreAccessDataSetTableAdapters.TableAdapterManager
    Friend WithEvents PerformancesBindingNavigator As System.Windows.Forms.BindingNavigator
    Friend WithEvents BindingNavigatorAddNewItem As System.Windows.Forms.ToolStripButton
    Friend WithEvents BindingNavigatorCountItem As System.Windows.Forms.ToolStripLabel
    Friend WithEvents BindingNavigatorDeleteItem As System.Windows.Forms.ToolStripButton
    Friend WithEvents BindingNavigatorMoveFirstItem As System.Windows.Forms.ToolStripButton
    Friend WithEvents BindingNavigatorMovePreviousItem As System.Windows.Forms.ToolStripButton
    Friend WithEvents BindingNavigatorSeparator As System.Windows.Forms.ToolStripSeparator
    Friend WithEvents BindingNavigatorPositionItem As System.Windows.Forms.ToolStripTextBox
    Friend WithEvents BindingNavigatorSeparator1 As System.Windows.Forms.ToolStripSeparator
    Friend WithEvents BindingNavigatorMoveNextItem As System.Windows.Forms.ToolStripButton
    Friend WithEvents BindingNavigatorMoveLastItem As System.Windows.Forms.ToolStripButton
    Friend WithEvents BindingNavigatorSeparator2 As System.Windows.Forms.ToolStripSeparator
    Friend WithEvents PerformancesBindingNavigatorSaveItem As System.Windows.Forms.ToolStripButton
    Friend WithEvents lblPrice As System.Windows.Forms.Label
End Class
