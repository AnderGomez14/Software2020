<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <html>
            <body>
                <h2>Preguntas</h2>
                <table border="2">
                    <tr bgcolor="#9acd32">
                        <th>Autor</th>
                        <th>Enunciado</th>
                        <th>Respuesta correcta</th>
                        <th>Respuestas incorrectas</th>
                        <th>Tema</th>
                    </tr>
                    <xsl:for-each select="assessmentItems/assessmentItem">
                        <tr>
                            <td>
                                <xsl:value-of select="@author" />
                            </td>
                            <td>
                                <xsl:value-of select="itemBody" />
                            </td>
                            <td>
                                <xsl:value-of select="correctResponse" />
                            </td>
                            <td>
                                <ul>
                                    <xsl:for-each select="incorrectResponses/response">
                                        <li>
                                            <xsl:value-of select="."/>
                                        </li>
                                    </xsl:for-each>
                                </ul>
                            </td>
                            <td>
                                <xsl:value-of select="@subject" />
                            </td>
                        </tr>
                    </xsl:for-each>
                </table>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>