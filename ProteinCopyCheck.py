__author__ = 'ehsan'
#Important notice: This Code just work with a tabular file that is sorted by qseqid
def Extractor (SourceFile, ResultFile):

    fw = open(ResultFile, "w")

    with open(SourceFile) as f:

        first_line = f.readline()
        first_line = first_line.rstrip()
        Mysplit = first_line.split("\t")
        for i in Mysplit:
            print (i)
            if i=="qseqid":
                qseqid=Mysplit.index(i)
            elif i=="ensemble":
                ensemble=Mysplit.index(i)
        print (Mysplit[qseqid]+"\t"+Mysplit[ensemble])
        fw.write("qseqid"+"\t"+"Gene paralogy status"+"\n")

        second_line = f.readline()
        second_line = second_line.rstrip()
        mynewsplit = second_line.split("\t")
        geneName=mynewsplit[qseqid]
        print (geneName)

        lines = f.readlines()
        templist=[]
        for line in lines:
            line = line.rstrip()
            linesplit = line.split("\t")
            if linesplit[qseqid]==geneName:
                templist.append(linesplit[ensemble])
            else:
                if "Paralog" in templist:
                    fw.write(geneName+"\t"+"Has Paralogous genes"+"\n")
                elif "HPD" in templist:
                    fw.write(geneName+"\t"+"Single Copy with paralogous domains"+"\n")
                else:
                    fw.write(geneName+"\t"+"Is Single Copy"+"\n")
                templist=[]
                geneName = linesplit[qseqid]

Extractor("testtabularresult.tabular", "testtabularresultNew.tabular")