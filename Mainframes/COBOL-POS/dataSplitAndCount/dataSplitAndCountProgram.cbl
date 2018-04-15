       identification division.
       program-id. dataSplitAndCountProgram.
       author. Francis Hackenberger, Sam Chard.

       environment division.
       input-output section.
       file-control.

           select input-file assign to '../../../data/valid-data.dat'
               organization is line sequential.
               
           select sales-file assign to 
               '../../../data/sales.dat' organization is line
               sequential.
               
           select returns-file assign to 
               '../../../data/returns.dat' organization is line
               sequential.
               
           select counts-and-controls-file assign to 
               '../../../data/counts-and-controls.out'
               organization is line sequential.

       data division.
       file section.
       
       fd input-file 
           data record is ipt-record.
           
       01 ipt-record.
           05 ipt-transaction-code                      pic x.
           05 ipt-transaction-amount                    pic 9(5)v99.
           05 ipt-payment-type                          pic xx.
           05 ipt-store-no                              pic xx.
           05 ipt-invoice-no                            pic x(9).
           05 ipt-sku-code                              pic x(15).
           
       fd sales-file
           data record is prt-sales-line.
           
       01 sales-data-line                               pic x(120).
       
       fd returns-file
           data record is prt-returns-line.
           
       01 returns-data-line                             pic x(120).
           
       01 prt-line.
           05 prt-transaction-code                      pic x.
           05 prt-transaction-amount                    pic 9(5)v99.
           05 prt-payment-type                          pic xx.
           05 prt-store-no                              pic xx.
           05 prt-invoice-no                            pic x(9).
           05 prt-sku-code                              pic x(15).
           
       fd counts-and-controls-file
           data record is prt-counts-and-controls-line.
           
       01 prt-counts-and-controls-line                  pic x(120).
       
       working-storage section.
       
       01 sw-eof                                       pic x 
           value 'n'.
           
       01 ws-counts-and-totals.
           05 ws-sales-records-count                   pic 999
               value 0.
           05 ws-layaways-records-count                pic 999
               value 0.
           05 ws-returns-records-count                 pic 999
               value 0.
           05 ws-total-sales-and-layaways-count        pic 999
               value 0.
           05 ws-ca-count                              pic 999
               value 0.
           05 ws-cr-count                              pic 999
               value 0.
           05 ws-db-count                              pic 999
               value 0.
           05 ws-ca-pct                                pic 999v9.
           05 ws-cr-pct                                pic 999v9.
           05 ws-db-pct                                pic 999v9.
           05 ws-sales-total-amount                    pic 9(6)v99.
           05 ws-layaways-total-amount                 pic 9(6)v99.
           05 ws-returns-total-amount                  pic 9(6)v99.
           05 ws-sales-and-layaway-total-amount        pic 9(6)v99.
           05 ws-grand-total-amount                    pic 9(6)v99.
           05 ws-grand-total-count                     pic 999
               value 0.
           05 ws-stores-amounts.
               10 ws-s-store-amount                    pic 9(6)v99
                   occurs 4 times value 0.
               10 ws-r-store-amount                    pic 9(6)v99
                   occurs 4 times value 0.
           05 ws-iterator                              pic 9
               value 1.
               
       01 ws-sales-and-layaways-heading.
           05 filler                                   pic x(30)
               value spaces.
           05 filler                                   pic x(16)
               value "SALES & LAYAWAYS".
           
       01 ws-returns-heading.
           05 filler                                   pic x(33)
               value spaces.
           05 filler                                   pic x(7)
               value "RETURNS".
           
       01 ws-sales-totals-line.
           05 filler                                   pic x(12)
               value "Sales Count:".
           05 filler                                   pic x(6)
               value spaces.
           05 ws-prt-sales-count                       pic zz9.
           05 filler                                   pic x(10)
               value spaces.
           05 filler                                   pic x(19)
               value "Total Sales Amount:".
           05 filler                                   pic x(6)
               value spaces.
           05 ws-prt-total-sales                       pic zzz,zz9.99.
               
       01 ws-layaways-totals-line.
           05 filler                                   pic x(15)
               value "Layaways Count:".
           05 filler                                   pic x(3)
               value spaces.
           05 ws-prt-layaways-count                    pic zz9.
           05 filler                                   pic x(10)
               value spaces.
           05 filler                                   pic x(22)
               value "Total Layaways Amount:".
           05 filler                                   pic x(3)
               value spaces.
           05 ws-prt-total-layaways-amount             pic zzz,zz9.99.
           
       01 ws-sl-totals-line.
           05 filler                                   pic x(16)
               value "Total S&L Count:".
           05 filler                                   pic x(3)
               value spaces.
           05 ws-prt-total-sl-count                    pic zz9.
           05 filler                                   pic x(9)
               value spaces.
           05 filler                                   pic x(17)
               value "Total S&L Amount:".
           05 filler                                   pic x(8)
               value spaces.
           05 ws-prt-total-sl-amount                   pic zzz,zz9.99.
           
       01 ws-s-stores-totals-line.
           05 filler                                   pic x(9)
               value "Store 01:".
           05 filler                                   pic x(1)
               value spaces.
           05 ws-s-prt-store-01                        pic zzz,zz9.99.
           05 filler                                   pic x(5)
               value spaces.
           05 filler                                   pic x(9)
               value "Store 02:".
           05 filler                                   pic x(1)
               value spaces.
           05 ws-s-prt-store-02                        pic zzz,zz9.99.
           05 filler                                   pic x(5)
               value spaces.
           05 filler                                   pic x(9)
               value "Store 03:".
           05 filler                                   pic x(1)
               value spaces.
           05 ws-s-prt-store-03                        pic zzz,zz9.99.
           05 filler                                   pic x(5)
               value spaces.
           05 filler                                   pic x(9)
               value "Store 07:".
           05 filler                                   pic x(1)
               value spaces.
           05 ws-s-prt-store-07                        pic zzz,zz9.99.
       
       01 ws-payment-type-pct-line.
           05 filler                                   pic x(14)
               value "CA percentage:".
           05 ws-prt-ca-pct                            pic zz9.9.
           05 filler                                   pic x(5)
               value spaces.
           05 filler                                   pic x(14)
               value "CR percentage:".
           05 ws-prt-cr-pct                            pic zz9.9.
           05 filler                                   pic x(5)
               value spaces.
           05 filler                                   pic x(14)
               value "DB percentage:".
           05 ws-prt-db-pct                            pic zz9.9.
           05 filler                                   pic x(5)
               value spaces.
       
       01 ws-returns-totals-line.
           05 filler                                   pic x(14)
               value "Returns Count:".
           05 filler                                   pic x(3)
               value spaces.
           05 ws-prt-returns-count                     pic zz9.
           05 filler                                   pic x(11)
               value spaces.
           05 filler                                   pic x(21)
               value "Total Returns Amount:".
           05 filler                                   pic x(4)
               value spaces.
           05 ws-prt-total-returns                     pic zzz,zz9.99.
           
       01 ws-r-stores-totals-line.
           05 filler                                   pic x(9)
               value "Store 01:".
           05 filler                                   pic x(1)
               value spaces.
           05 ws-r-prt-store-01                        pic zzz,zz9.99.
           05 filler                                   pic x(5)
               value spaces.
           05 filler                                   pic x(9)
               value "Store 02:".
           05 filler                                   pic x(1)
               value spaces.
           05 ws-r-prt-store-02                        pic zzz,zz9.99.
           05 filler                                   pic x(5)
               value spaces.
           05 filler                                   pic x(9)
               value "Store 03:".
           05 filler                                   pic x(1)
               value spaces.
           05 ws-r-prt-store-03                        pic zzz,zz9.99.
           05 filler                                   pic x(5)
               value spaces.
           05 filler                                   pic x(9)
               value "Store 07:".
           05 filler                                   pic x(1)
               value spaces.
           05 ws-r-prt-store-07                        pic zzz,zz9.99.
           
       01 ws-grand-totals-line.
           05 filler                                   pic x(18)
               value "Grand Total Count:".
           05 filler                                   pic x(3)
               value spaces.
           05 ws-prt-grand-total-count                 pic zz9.
           05 filler                                   pic x(10)
               value spaces.
           05 filler                                   pic x(19)
               value "Grand Total Amount:".
           05 filler                                   pic x(3)
               value spaces.
           05 ws-prt-grand-total-amount                pic z(5)9.99.
       
                   
       procedure division.
       
            *> open files
           open input input-file,
               output sales-file, returns-file, 
                   counts-and-controls-file
           
           *> Perform Validation
           perform 100-process-records.
           
           *> Perform totals
           perform 200-totals.
           
           perform 300-print-totals.
                   
           accept return-code.
           
           *> close files
           close input-file, sales-file, returns-file, 
               counts-and-controls-file

           goback.
           
       
       100-process-records.
       
           read input-file at end move "Y" to sw-eof.
               perform until sw-eof = "Y"
               
               *> Clear lines for processing
               move spaces to prt-line
               move spaces to sales-data-line
               move spaces to returns-data-line
               move spaces to prt-counts-and-controls-line
               
               *> Move values to print
               move ipt-transaction-code to prt-transaction-code
               move ipt-transaction-amount to prt-transaction-amount
               move ipt-payment-type to prt-payment-type
               move ipt-invoice-no to prt-invoice-no
               move ipt-store-no to prt-store-no
               move ipt-sku-code to prt-sku-code
               
               *> Split Data
               if (ipt-transaction-code = "S" or 
                   ipt-transaction-code = "L") then
                   add 1 to ws-total-sales-and-layaways-count
                   *> Sales & Layaway
                   perform 130-process-sales
                   write sales-data-line from prt-line
               else
                   add 1 to ws-returns-records-count
                   *> Returns
                   perform 160-process-returns
                   write returns-data-line from prt-line
               end-if
               
               add 1 to ws-grand-total-count
      
           read input-file at end move "Y" to sw-eof
               end-perform.
       
       130-process-sales.
           *> Process the records
           *> Use array to keep store amounts
           evaluate ipt-store-no
           when "01"
               add ipt-transaction-amount to ws-s-store-amount(1)
           when "02"
               add ipt-transaction-amount to ws-s-store-amount(2)
           when "03"
               add ipt-transaction-amount to ws-s-store-amount(3)
           when "07"
               add ipt-transaction-amount to ws-s-store-amount(4)
           end-evaluate.
           
           evaluate ipt-payment-type
           when "CA"
               add 1 to ws-ca-count
           when "CR"
               add 1 to ws-cr-count
           when "DB"
               add 1 to ws-db-count
           end-evaluate.
           
           evaluate ipt-transaction-code
           when "S"
               add 1 to ws-sales-records-count
               add ipt-transaction-amount to ws-sales-total-amount
           when "L"
               add 1 to ws-layaways-records-count
               add ipt-transaction-amount to ws-layaways-total-amount
           end-evaluate.
           
           add ipt-transaction-amount to 
               ws-sales-and-layaway-total-amount.
       
       160-process-returns.
           *> Process the records
           *> Use array to keep store amounts
           evaluate ipt-store-no
           when "01"
               add ipt-transaction-amount to ws-r-store-amount(1)
           when "02"
               add ipt-transaction-amount to ws-r-store-amount(2)
           when "03"
               add ipt-transaction-amount to ws-r-store-amount(3)
           when "07"
               add ipt-transaction-amount to ws-r-store-amount(4)
           end-evaluate.
           
           add ipt-transaction-amount to ws-returns-total-amount.
           
       200-totals.
       
           compute ws-grand-total-amount = 
           ws-sales-and-layaway-total-amount - ws-returns-total-amount.
           
           *> % of transactions in payment type categories
           compute ws-ca-pct rounded =
               (ws-total-sales-and-layaways-count / ws-ca-count) * 10.
           
           compute ws-cr-pct rounded =
               (ws-total-sales-and-layaways-count / ws-cr-count) * 10.
           
           compute ws-db-pct rounded =
               (ws-total-sales-and-layaways-count / ws-db-count) * 10.
               
               
       300-print-totals.
       
            *> Move values to print
            move ws-sales-records-count to ws-prt-sales-count.
            move ws-sales-total-amount to ws-prt-total-sales.
               
            move ws-layaways-records-count to ws-prt-layaways-count.
            move ws-layaways-total-amount to 
                ws-prt-total-layaways-amount.
                    
            move ws-total-sales-and-layaways-count to 
                ws-prt-total-sl-count.
            move ws-sales-and-layaway-total-amount to
                ws-prt-total-sl-amount.
                    
            move ws-s-store-amount(1) to ws-s-prt-store-01.
            move ws-s-store-amount(2) to ws-s-prt-store-02.
            move ws-s-store-amount(3) to ws-s-prt-store-03.
            move ws-s-store-amount(4) to ws-s-prt-store-07.
               
            move ws-ca-pct to ws-prt-ca-pct.
            move ws-cr-pct to ws-prt-cr-pct.
            move ws-db-pct to ws-prt-db-pct.
               
            move ws-returns-records-count to ws-prt-returns-count.
            move ws-returns-total-amount to 
                ws-prt-total-returns.
                    
            move ws-r-store-amount(1) to ws-r-prt-store-01.
            move ws-r-store-amount(2) to ws-r-prt-store-02.
            move ws-r-store-amount(3) to ws-r-prt-store-03.
            move ws-r-store-amount(4) to ws-r-prt-store-07.
               
            move ws-grand-total-count to ws-prt-grand-total-count.
            move ws-grand-total-amount to ws-prt-grand-total-amount.
     
            *> Write counts and controls file
            move ws-sales-and-layaways-heading to 
                 prt-counts-and-controls-line.
            write prt-counts-and-controls-line.
            
            move ws-sales-totals-line to prt-counts-and-controls-line.
            write prt-counts-and-controls-line after advancing 1 line.
            
            move ws-layaways-totals-line to 
                 prt-counts-and-controls-line.
            write prt-counts-and-controls-line.
            
            move ws-sl-totals-line to prt-counts-and-controls-line.
            write prt-counts-and-controls-line.
            
            move ws-payment-type-pct-line to 
                 prt-counts-and-controls-line.
            write prt-counts-and-controls-line.
            
            move ws-s-stores-totals-line to 
                 prt-counts-and-controls-line.
            write prt-counts-and-controls-line.
            
            move ws-returns-heading to prt-counts-and-controls-line
            write prt-counts-and-controls-line after advancing 2 lines.
            
            move ws-returns-totals-line to prt-counts-and-controls-line.
            write prt-counts-and-controls-line after advancing 2 lines.
            
            move ws-r-stores-totals-line to 
                 prt-counts-and-controls-line.
            write prt-counts-and-controls-line.
            
            move ws-grand-totals-line to prt-counts-and-controls-line.
            write prt-counts-and-controls-line after advancing 2 lines.
               
       end program dataSplitAndCountProgram.