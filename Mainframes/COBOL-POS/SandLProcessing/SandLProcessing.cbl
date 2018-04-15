       identification division.
       program-id. SandLProcessingProgram
       author. Francis Hackenberger, Sam chard.

       environment division.
       input-output section.
       file-control.

           select input-file assign to '../../../data/sales.dat'
               organization is line sequential.
               
           select report-file assign to 
               '../../../data/sales-report.dat' organization is line
               sequential.

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
           
       fd report-file
           data record is sales-data-line.
           
       01 sales-data-line                               pic x(120).
       
       01 prt-line.
           05 filler                                    pic x(3)
               value spaces.
           05 prt-transaction-code                      pic x.
           05 filler                                    pic x(8)
               value spaces.
           05 prt-transaction-amount                    pic z(5)9.99.
           05 filler                                    pic x(8)
               value spaces.
           05 prt-payment-type                          pic xx.
           05 filler                                    pic x(8)
               value spaces.
           05 prt-store-no                              pic xx.
           05 filler                                    pic x(5)
               value spaces.
           05 prt-invoice-no                            pic x(9).
           05 filler                                    pic x(3)
               value spaces.
           05 prt-sku-code                              pic x(15).
           05 filler                                    pic x(2)
               value spaces.
           05 prt-taxes                                 pic z(4)9.99.

       working-storage section.
       01 sw-eof                                        pic x 
           value 'n'.
          
       01 report-heading-line.
           05 filler                                    pic x(30)
               value spaces.
           05 filler                                    pic x(10)
               value "S&L REPORT".
       
       01 headings-line1.
           05 filler                                    pic x(11)
               value "TRANSACTION".
           05 filler                                    pic x(2)
               value spaces.
           05 filler                                    pic x(11)
               value "TRANSACTION".   
           05 filler                                    pic x(3)
               value spaces.
           05 filler                                    pic x(7)
               value "PAYMENT".
           05 filler                                    pic x(3)
               value spaces.
           05 filler                                    pic x(5)
               value "STORE".
           05 filler                                    pic x(4)
               value spaces.
           05 filler                                    pic x(7)
               value "INVOICE".
           05 filler                                    pic x(8)
               value spaces.
           05 filler                                    pic x(8)
               value "SKU CODE".
           05 filler                                    pic x(10)
               value spaces.
           05 filler                                    pic x(3)
               value "TAX".
               
       01 headings-line2.
           05 filler                                    pic x(2)
               value spaces.
           05 filler                                    pic x(4)
               value "CODE".
           05 filler                                    pic x(9)
               value spaces.
           05 filler                                    pic x(6)
               value "AMOUNT".  
           05 filler                                    pic x(7)
               value spaces.
           05 filler                                    pic x(4)
               value "TYPE".
           05 filler                                    pic x(5)
               value spaces.
           05 filler                                    pic x(6)
               value "NUMBER".
           05 filler                                    pic x(4)
               value spaces.
           05 filler                                    pic x(6)
               value "NUMBER".
           05 filler                                    pic x(6)
               value spaces.
       
       01 ws-constants.
           05 ws-tax-rate                               pic v999
               value 0.13.
       
       01 ws-transaction-amount                         pic 9(6)v99.
       01 ws-tax-owing                                  pic 9(6)v99.
           
       01 ws-counts-and-totals.
           05 ws-sales-records-count                   pic 9999
               value 0.
           05 ws-layaways-records-count                pic 9999
               value 0.
           05 ws-ca-count                              pic 9999
               value 0.
           05 ws-cr-count                              pic 9999
               value 0.
           05 ws-db-count                              pic 9999
               value 0.
           05 ws-ca-pct                                pic 999v9.
           05 ws-cr-pct                                pic 999v9.
           05 ws-db-pct                                pic 999v9.
           05 ws-sales-total-amount                    pic 9(6)v99.
           05 ws-layaways-total-amount                 pic 9(6)v99.
           05 ws-total-tax-owing                       pic 9(6)v99.
           05 ws-stores-amounts.
               10 ws-store-amount                      pic 9(6)v99
                   occurs 4 times value 0.
           05 ws-stores-numbers.
               10 ws-store-number                      pic xx
                   occurs 4 times.
           05 ws-iterator                              pic 9
               value 1.
           05 ws-highest-store-amount                  pic 9(6)v99
               value 0.
           05 ws-page-count                            pic 99
               value 1.
           05 ws-line-count                            pic 99
               value 0.
           05 ws-lines-per-page                        pic 99
               value 20.
       
       01 prt-page-number-line.
           05 filler                                   pic x(6)
               value "Page #".
           05 prt-page-count                           pic zz9
               value 1.
       01 totals-line1.
           05 filler                                   pic x(20)
               value "Total Sales Records:".
           05 filler                                   pic x(5)
               value spaces.
           05 prt-total-sales-count                    pic z(4).
           05 filler                                   pic x(3)
               value spaces.
           05 filler                                   pic x(13)
               value "Total Amount:".
           05 filler                                   pic x(2)
               value spaces.
           05 prt-total-sales-amount                   pic zzz,zz9.99.
           
       01 totals-line2.
           05 filler                                   pic x(23)
               value "Total Layaways Records:".
           05 filler                                   pic x(2)
               value spaces.
           05 prt-total-layaways-count                 pic z(4).
           05 filler                                   pic x(3)
               value spaces.
           05 filler                                   pic x(13)
               value "Total Amount:".
           05 filler                                   pic x(2)
               value spaces.
           05 prt-total-layaways-amount                pic zzz,zz9.99.
           
       01 totals-line3.
           05 filler                                   pic x(16)
               value "Total Tax Owing:".
           05 filler                                   pic x(9)
               value spaces.
           05 prt-total-tax-owing                      pic zzz,zz9.99.
           
       01 totals-line4.
           05 filler                                   pic x(25)
               value "Payment Type Percentages:".
           05 filler                                   pic x(3)
               value spaces.
           05 filler                                   pic x(3)
               value "CA:".
           05 filler                                   pic x(2)
               value spaces.
           05 prt-ca-pct                               pic zz9.9.
           05 filler                                   pic x(3)
               value spaces.
           05 filler                                   pic x(3)
               value "CR:".
           05 filler                                   pic x(2)
               value spaces.
           05 prt-cr-pct                               pic zz9.9.
           05 filler                                   pic x(3)
               value spaces.
           05 filler                                   pic x(3)
               value "DB:".
           05 filler                                   pic x(2)
               value spaces.
           05 prt-db-pct                               pic zz9.9.
           
       01 totals-line5.
           05 filler                                   pic x(42)
               value "Store with highest S&L transaction amount:".
           05 filler                                   pic xxx
               value spaces.
           05 prt-highest-amount-store                 pic xx.
           05 filler                                   pic x(3)
               value spaces.
           05 filler                                   pic x(7)
               value "Amount:".
           05 filler                                   pic xx
               value spaces.
           05 prt-highest-store-amount                 pic zzz,zz9.99.

       procedure division.

           *> Open files
           open input input-file,
               output report-file,
           
           write prt-line from report-heading-line.
           *> Perform Print Heading
           perform 50-print-headings.
           
           *> Perform Validation
           perform 100-process-lines.
           
           *> Perform print
           perform 200-totals.
           
           accept return-code.
           
           *> close files
           close input-file, report-file
           
           goback.
           

       50-print-headings.
           write prt-line from prt-page-number-line after 
               advancing page.
           write prt-line from headings-line1 after advancing 2 lines.
           write prt-line from headings-line2.
       
       100-process-lines.
       
           read input-file at end move "Y" to sw-eof.
           perform until sw-eof = "Y"
           
           if ws-line-count = ws-lines-per-page
                   add 1 to ws-page-count
                   move ws-page-count to prt-page-count
                   perform 50-print-headings
                   move 0 to ws-line-count
           end-if
               
           add 1 to ws-line-count
           
           move spaces to prt-line
           move ipt-transaction-amount to ws-transaction-amount
           
           compute ws-tax-owing rounded =
                   (ws-transaction-amount * ws-tax-rate)
           
           move ipt-transaction-code to prt-transaction-code
           move ipt-transaction-amount to prt-transaction-amount
           move ipt-payment-type to prt-payment-type
           move ipt-store-no to prt-store-no
           move ipt-invoice-no to prt-invoice-no
           move ipt-sku-code to prt-sku-code
           move ws-tax-owing to prt-taxes
           
           *> Counts & Totals
           evaluate ipt-transaction-code
               when "S"
                   add 1 to ws-sales-records-count
                   add ws-transaction-amount to ws-sales-total-amount
               when "L"
                   add 1 to ws-layaways-records-count
                   add ws-transaction-amount to ws-layaways-total-amount
           end-evaluate
           
           evaluate ipt-payment-type
               when "CA"
                   add 1 to ws-ca-count
               when "CR"
                   add 1 to ws-cr-count
               when "DB"
                   add 1 to ws-db-count
           end-evaluate
           
           evaluate ipt-store-no
           when "01"
               add ipt-transaction-amount to ws-store-amount(1)
           when "02"
               add ipt-transaction-amount to ws-store-amount(2)
           when "03"
               add ipt-transaction-amount to ws-store-amount(3)
           when "07"
               add ipt-transaction-amount to ws-store-amount(4)
           end-evaluate
           
           add ws-tax-owing to ws-total-tax-owing
    
           write prt-line from sales-data-line after advancing 1 line
           
           read input-file at end move "Y" to sw-eof
           end-perform.
       
       200-totals.
           
           move "01" to ws-store-number(1).
           move "02" to ws-store-number(2).
           move "03" to ws-store-number(3).
           move "07" to ws-store-number(4).
           
           *> % of transactions in payment type categories
           compute ws-ca-pct rounded =
               ((ws-sales-records-count + ws-layaways-records-count)
               /ws-ca-count) * 10.
           
           compute ws-cr-pct rounded =
               ((ws-sales-records-count + ws-layaways-records-count)
               /ws-cr-count) * 10.
           
           compute ws-db-pct rounded =
               ((ws-sales-records-count + ws-layaways-records-count)
               /ws-db-count) * 10.
               
           *> Determine store with the highest S&L amount
           move 1 to ws-iterator.
           perform varying ws-iterator
               from 1
               by 1
               until ws-iterator > 4
               if (ws-store-amount(ws-iterator) > 
                   ws-highest-store-amount) then
                   move ws-store-amount(ws-iterator)
                       to ws-highest-store-amount
               end-if
               if (ws-highest-store-amount = 
                   ws-store-amount(ws-iterator)) then
                   move ws-store-number(ws-iterator) to 
                       prt-highest-amount-store
               end-if
           end-perform.
          
           move ws-highest-store-amount to prt-highest-store-amount.
               
           move ws-ca-pct to prt-ca-pct.
           move ws-cr-pct to prt-cr-pct.
           move ws-db-pct to prt-db-pct.
               
           move ws-sales-records-count to prt-total-sales-count.
           move ws-sales-total-amount to prt-total-sales-amount.
           move ws-layaways-records-count to prt-total-layaways-count.
           move ws-layaways-total-amount to prt-total-layaways-amount.
           move ws-total-tax-owing to prt-total-tax-owing.
           
           write prt-line from totals-line1 after advancing 2 lines.
           write prt-line from totals-line2.
           write prt-line from totals-line3.
           write prt-line from totals-line4.
           write prt-line from totals-line5.
       
       end program SandLProcessingProgram.
       
       