import {Box, Heading} from "@chakra-ui/react";
import Zakup from "@/app/components/Zakup";

export default function PurchaseData({ purchaseData }) {
    return (
        <>
            <Box mt="16px">
                <Box as="label">
                    Наименование площадки:
                    <Zakup val={purchaseData.etp.name} />
                </Box>
            </Box>

            <Box mt="16px">
                <Box as="label">
                    Начальная максимальная цена закупки (НМЦ):
                    <Zakup val={purchaseData.max_price} />
                </Box>
            </Box>

            <Heading size="md" mt="16px">Информация о заказчике</Heading>

            <Box mt="16px">
                <Box as="label">
                    Наименование:
                    <Zakup val={purchaseData.responsible_name} />
                </Box>
            </Box>

            <Box mt="16px">
                <Box as="label">
                    Адрес:
                    <Zakup val={purchaseData.responsible_org.fact_address} />
                </Box>
            </Box>

            <Box mt="16px">
                <Box as="label">
                    ИНН:
                    <Zakup val={purchaseData.responsible_org.inn} />
                </Box>
            </Box>

            <Box mt="16px">
                <Box as="label">
                    КПП:
                    <Zakup val={purchaseData.responsible_org.kpp} />
                </Box>
            </Box>
        </>
    )
}