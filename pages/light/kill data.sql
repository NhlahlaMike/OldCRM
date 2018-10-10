



DECLARE @dbname NVARCHAR(128)
SET @dbname = 'IKWOR.CO.ZA'
 -- db to drop connections 
DECLARE @processid INT 
SELECT  @processid = MIN(spid)
FROM    master.dbo.sysprocesses
WHERE   dbid = DB_ID(@dbname) 
WHILE @processid IS NOT NULL 
    BEGIN 
        EXEC ('KILL ' + @processid) 
        SELECT  @processid = MIN(spid)
        FROM    master.dbo.sysprocesses
        WHERE   dbid = DB_ID(@dbname) 
    END

